<?php
/*
 * Copyright 2016, Google Inc.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are
 * met:
 *
 *     * Redistributions of source code must retain the above copyright
 * notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above
 * copyright notice, this list of conditions and the following disclaimer
 * in the documentation and/or other materials provided with the
 * distribution.
 *     * Neither the name of Google Inc. nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

/**
 * This script performs find/replace operations on the generated protoc
 * output.
 *
 * NOTE: As new cases are handled, this script must remain idempotent.
 *
 * This script is a temporary solution, until this rename functionality
 * can be incorporated into PHP protoc, gRPC protoc plugin, or artman.
 */

$dir = new RecursiveDirectoryIterator('src');
$it = new RecursiveIteratorIterator($dir);
$reg = new RegexIterator($it, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
foreach ($reg as $files) {
    $file = $files[0];
    $str = file_get_contents($file);
    $str = str_replace("const LIST ", "const PBLIST ", $str);
    $str = str_replace("const AND ", "const PBAND ", $str);
    $str = str_replace("const NEW ", "const PBNEW ", $str);
    $str = str_replace("const DEFAULT ", "const PBDEFAULT ", $str);
    file_put_contents($file, $str);
}
