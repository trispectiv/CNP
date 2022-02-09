<h1>CNP validator according to Romanian legislation</h1>

```
function isCnpValid(string $value): bool
```

Returns <b>true</b> if a valid CNP is passed.

<h2>Unit testing</h2>
A sample PHPUnit testing file is provided. Simply use:

```
phpunit cnp_test.php <CNP>
```

where <CNP> is the CNP you would like to validate. If you don't have any data to feed your testing, you can use the following candidates:

Valid (returns true):
-1070504429315
-2700116065277
-4910527475018

Bogus (return false):
-27001160C5277 (has a non-digit character)
-2701316065277 (has month value bigger than 12)
-2701135065277 (has day value bigger than 31)
-2701116555277 (has county value bigger than 52)
-2701116065271 (has invalid checksum)

<h2>Generator</h2>
A random CNP generator is provided in order to generate valid candidates. Simply use:

```
php generate_candidates.php
```

and the script will output a valid candidate.

Have fun! ;-)
