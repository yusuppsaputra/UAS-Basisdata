<?php

namespace App\Console\Commands;

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Illuminate\Console\Command;

class CreateMinioBucket extends Command
{
    protected $signature = 'minio:ensure-bucket {--bucket=}';
    protected $description = 'Ensure MinIO bucket exists and is public';

    public function handle()
    {
        $disk = config('filesystems.disks.minio', []);

        $bucket = $this->option('bucket') ?: ($disk['bucket'] ?? env('MINIO_BUCKET'));
        if (empty($bucket)) {
            $this->error('No bucket configured. Set MINIO_BUCKET in .env or pass --bucket.');
            return 1;
        }

        $key = $disk['key'] ?? env('MINIO_ACCESS_KEY');
        $secret = $disk['secret'] ?? env('MINIO_SECRET_KEY');
        $region = $disk['region'] ?? env('MINIO_REGION', 'us-east-1');
        $endpoint = $disk['endpoint'] ?? env('MINIO_ENDPOINT');
        $usePathStyle = filter_var($disk['use_path_style_endpoint'] ?? env('MINIO_USE_PATH_STYLE_ENDPOINT', true), FILTER_VALIDATE_BOOLEAN);

        $this->info("Using bucket: {$bucket}");

        $client = new S3Client([
            'version' => 'latest',
            'region' => $region,
            'endpoint' => $endpoint,
            'use_path_style_endpoint' => $usePathStyle,
            'credentials' => [
                'key' => $key,
                'secret' => $secret,
            ],
        ]);

        try {
            // Check if bucket exists
            $client->headBucket(['Bucket' => $bucket]);

            $this->info("Bucket '{$bucket}' already exists.");
        } catch (S3Exception $e) {
            // If not found, create it
            if ($e->getAwsErrorCode() === 'NotFound' || $e->getStatusCode() === 404) {
                $this->info("Bucket '{$bucket}' not found, creating...");
                $client->createBucket(['Bucket' => $bucket]);

                // set a public read policy
                $policy = [
                    'Version' => '2012-10-17',
                    'Statement' => [
                        [
                            'Sid' => 'PublicReadGetObject',
                            'Effect' => 'Allow',
                            'Principal' => '*',
                            'Action' => ['s3:GetObject'],
                            'Resource' => "arn:aws:s3:::{$bucket}/*",
                        ],
                    ],
                ];

                $client->putBucketPolicy([
                    'Bucket' => $bucket,
                    'Policy' => json_encode($policy),
                ]);

                $this->info("Bucket '{$bucket}' created and policy applied.");
            } else {
                $this->error('Error checking/creating bucket: ' . $e->getMessage());
                return 1;
            }
        } catch (\Exception $e) {
            $this->error('Unexpected error: ' . $e->getMessage());
            return 1;
        }

        return 0;
    }
}
