<?php

use Database\MySQLWrapper;

// computer partのIDを取得・確認
$id = $_GET['id'] ?? null;
if (!$id) {
    die("No ID provided for computer part");
}

// DB接続を初期化
$db = new MySQLWrapper();

try {
    // 特定のidのパーツを取得
    $stmt = $db->prepare("SELECT * FROM computer_parts WHERE id = ?");
    // int型にidをバインド
    $stmt->bind_param('i', $id);
    // ステートメントを実行
    $stmt->execute();
    // 結果を取得し、該当項目を１行取得
    $result = $stmt->get_result();
    $part = $result->fetch_assoc();
} catch (Exception $e) {
    die("Error fetching part: " . $e->getMessage());
}

//TODO: 上記のロジックをViewから分離

?>
<div class="card" style="width: 18rem;">
    <div class="card-body">
        <h5 class="card-title">
            <?= htmlspecialchars($part['name']) ?>
        </h5>
        <h6 class="card-subtitle mb-2 text-muted">
            <?= htmlspecialchars($part['type']) ?> -
            <?= htmlspecialchars($part['brand']) ?>
        </h6>
        <p class="card-text">
            <strong>Model:</strong>
            <?= htmlspecialchars($part['model_number']) ?><br />
            <strong>Release Date:</strong>
            <?= htmlspecialchars($part['release_date']) ?><br />
            <strong>Description:</strong>
            <?= htmlspecialchars($part['description']) ?><br />
            <strong>Performance Score:</strong>
            <?= htmlspecialchars($part['performance_score']) ?><br />
            <strong>Market Price:</strong> $
            <?= htmlspecialchars($part['market_price']) ?><br />
            <strong>RSM:</strong> $
            <?= htmlspecialchars($part['rsm']) ?><br />
            <strong>Power Consumption:</strong>
            <?= htmlspecialchars($part['power_consumptionw']) ?>W<br />
            <strong>Dimensions:</strong>
            <?= htmlspecialchars($part['lengthm']) ?>m x
            <?= htmlspecialchars($part['widthm']) ?>m x
            <?= htmlspecialchars($part['heightm']) ?>m<br />
            <strong>Lifespan:</strong>
            <?= htmlspecialchars($part['lifespan']) ?> years<br />
        </p>
        <p class="card-text"><small class="text-muted">Last updated on
                <?= htmlspecialchars($part['updated_at']) ?>
            </small></p>
    </div>
</div>