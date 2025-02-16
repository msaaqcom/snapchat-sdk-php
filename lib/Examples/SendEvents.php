<?php

declare(strict_types=1);

namespace SnapBusinessSDK;

require_once __DIR__.'../../..'.'/vendor/autoload.php';

use SnapBusinessSDK\Api\ConversionApi;
use SnapBusinessSDK\Model\CapiEvent;

const API_TOKEN = 'YOUR_API_TOKEN';
const PIXEL_ID = 'YOUR_PIXEL_ID';
const LAUNCH_PAD_URL = 'http://localhost:8080';

$capi = new ConversionApi(API_TOKEN);
// Please use the following line if the LaunchPad is available.
// $capi = new ConversionApi(API_TOKEN, LAUNCH_PAD_URL);

// (Optional) Enable logging
$capi->setDebugging(true);

// Use Case 1: Send an event asynchronously
$capiEvent1 = (new CapiEvent)
    ->setPixelId(PIXEL_ID)
    ->setEventConversionType('WEB')
    ->setEventType('CUSTOM_EVENT_1')
    ->setTimestamp('1656022510346')
    // The following PII fields are hashed by SHA256 before being sent to CAPI.
    // Alternatively, you can use hashed-field setters (e.g. setHashedEmail()) to set the hashed value directly.
    ->setEmail('mocking-email')
    ->setIpAddress('mocking-ip')
    ->setPhoneNumber('mocking-phone-num');

$capi->sendEvent($capiEvent1);

// Use Case 2: Send batching events asynchronously (up to 2000 events in one batch)
$capiEvent2 = (new CapiEvent)
    ->setPixelId(PIXEL_ID)
    ->setEventConversionType('WEB')
    ->setEventType('CUSTOM_EVENT_2')
    ->setTimestamp('1656022510346')
    ->setEmail('mocking-email')
    ->setIpAddress('mocking-ip')
    ->setPhoneNumber('mocking-phone-num');

$capi->sendEvents([$capiEvent1, $capiEvent2]);
