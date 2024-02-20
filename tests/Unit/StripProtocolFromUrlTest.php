<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class StripProtocolFromUrlTest extends TestCase
{
    public function testProtocolStrippedFromUrl(): void
    {
        $protocols = [
            "https", "ftps", "compress.zlib", "php", "file", "glob", "data",
            "wss", "ws", "git", "git+ssh", "sftp", "smb", "ogg", "expect", "zlib",
            "http", "ftp", "compress.bzip2", "phar", "ssh2.shell", "ssh2.exec",
            "ssh2.tunnel", "ssh2.scp", "ssh2.sftp", "zip", "compress.zstd", "rar",
            "phar"
        ];

        foreach($protocols as $protocol) {
            $this->assertSame("google.com", url_strip_protocol(sprintf("%s://google.com", $protocol)));
        }
    }
}
