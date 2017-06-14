<?php

namespace App\Providers;

class StojansResponse {

    public function onSuccess($response) {

        echo json_encode(['success' => true, 'message' => 'Successfully found books', 'data' => $response], JSON_PRETTY_PRINT);

    }

    public function onFailure($status) {

        echo json_encode(['success' => false, 'message' => 'Unable to find book', 'reason' => $status], JSON_PRETTY_PRINT);

    }
}

?>