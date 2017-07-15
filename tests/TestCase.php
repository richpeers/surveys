<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Webmozart\Assert\Assert;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
}
