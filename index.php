<?php

@include_once __DIR__ . '/vendor/autoload.php';

Kirby::plugin('candyblue/kirby3-gpa', [
  'options' => [
    'key' => '',
    'place' => '',
  ]
]);

function gpaData() {
  if(!empty(option('candyblue.kirby3-gpa.key')) && !empty(option('candyblue.kirby3-gpa.place'))) {
    $key = option('candyblue.kirby3-gpa.key');
    $place = option('candyblue.kirby3-gtm.place');
    $json_url = "https://maps.googleapis.com/maps/api/place/details/json?placeid={$place}&fields=user_ratings_total,rating&key={$key}";
    $json_content = file_get_contents($json_url);
    $json_data = json_decode($json_content, true);

    return $json_data;
  }
}

function gpaRating() {
  if(!empty(gpaData())) {
    $rating = gpaData()['result']['rating'];
    return $rating;
  }
}

function gpaUserRatingsTotal() {
  if(!empty(gpaData())) {
    $user_ratings_total = gpaData()['result']['user_ratings_total'];
    return $user_ratings_total;
  }
}
