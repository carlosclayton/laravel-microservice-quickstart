<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Traits\ModelValidation;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, WithFaker, DatabaseMigrations, DatabaseTransactions, ModelValidation;



}
