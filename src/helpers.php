<?php

namespace
{
    use Carbon\Carbon;

    if (!function_exists('not_in_array')) {
        /**
         * The inverse of "in_array".
         *
         * @param  mixed  $var
         * @param  array  $array
         *
         * @return bool
         */
        function not_in_array(mixed $var, array $array): bool
        {
            return !in_array($var, $array);
        }
    }

    if (!function_exists('not_null')) {
        /**
         * The inverse of "is_null".
         *
         * @param mixed $var
         * @return bool
         */
        function not_null(mixed $var): bool
        {
            return !is_null($var);
        }
    }

    if (!function_exists('url_strip_protocol')) {
        /**
         * Strip the protocol from a URL and return only the domain name.
         *
         * @param  string  $url
         *
         * @return string
         * @throws InvalidUrlException
         */
        function url_strip_protocol(string $url): string
        {
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                throw new InvalidUrlException('The given URL is invalid.');
            }
            if (\Illuminate\Support\Str::startsWith($url,
                [
                    "https", "ftps", "compress.zlib", "php", "file", "glob", "data",
                    "wss", "ws", "git", "git+ssh", "sftp", "smb", "ogg", "expect", "zlib",
                    "http", "ftp", "compress.bzip2", "phar", "ssh2.shell", "ssh2.exec",
                    "ssh2.tunnel", "ssh2.scp", "ssh2.sftp", "zip", "compress.zstd", "rar",
                    "phar",
                ])) {
                return explode('://', $url)[1];
            }
        }
    }

    if (!function_exists('duration')) {
        /**
         * Convert a twitch clip/stream duration to a readable format.
         */
        function duration(string $duration): string
        {
            if (str_contains($duration, 'h')) {
                preg_match('/([0-9]{1,2})h([0-9]{1,2})m([0-9]{1,2})s/', $duration, $matches);
                $uses_hours = true;
            } else {
                preg_match('/([0-9]{1,2})m([0-9]{1,2})s/', $duration, $matches);
                $uses_hours = false;
            }

            if ($uses_hours) {
                $hours = strlen($matches[1]) === 1 ? str_pad(sprintf('%s', $matches[1]), 2, 0, STR_PAD_LEFT) : $matches[1];
                $minutes = strlen($matches[2]) === 1 ? str_pad(sprintf('%s', $matches[2]), 2, 0, STR_PAD_LEFT) : $matches[2];
                $seconds = strlen($matches[3]) === 1 ? str_pad(sprintf('%s', $matches[3]), 2, 0, STR_PAD_LEFT) : $matches[3];

                return Carbon::createFromFormat('H:i:s', $hours.':'.$minutes.':'.$seconds)->format('H:i:s');
            }

            $minutes = strlen($matches[1]) === 1 ? str_pad(sprintf('%s', $matches[1]), 2, 0, STR_PAD_LEFT) : $matches[1];
            $seconds = strlen($matches[2]) === 1 ? str_pad(sprintf('%s', $matches[2]), 2, 0, STR_PAD_LEFT) : $matches[2];

            return Carbon::createFromFormat('i:s', $minutes.':'.$seconds)->format('H:i:s');
        }
    }
}
