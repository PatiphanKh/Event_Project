<?php

// รับค่าคำค้นหา (ถ้ามีการพิมพ์ค้นหา)
$searchQuery = $_GET['search'] ?? '';
$dateFrom    = $_GET['date_from'] ?? '';
$dateTo      = $_GET['date_to']   ?? '';

$events = getAllEvents($searchQuery, $dateFrom, $dateTo);

renderView('home', [
    'events'      => $events,
    'searchQuery' => $searchQuery,
    'dateFrom'    => $dateFrom,
    'dateTo'      => $dateTo,
]);