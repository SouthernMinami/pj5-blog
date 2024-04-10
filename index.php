<?php
spl_autoload_extensions(".php");
spl_autoload_register(function ($class) {
    $namespace = explode('\\', $class);
    $file = __DIR__ . '/' . implode('/', $namespace) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// デバッグモードを設定
$DEBUG = true;

// ルートをロード
$routes = include ('Routing/routes.php');

// リクエストURIからパスを取得
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = ltrim($path, '/');

// ルートパスの一致を確認
if (isset($routes[$path])) {
    // コールバックを呼び出してrendererを作成。
    $renderer = $routes[$path]();

    try {
        // ヘッダーを設定
        foreach ($renderer->getFields() as $name => $value) {
            // ヘッダーに設定する値をサニタイズ
            $sanitized_value = filter_var($value, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);

            // サニタイズされた値が元の値と一致する場合、ヘッダーを設定する
            if ($sanitized_value && $sanitized_value === $value) {
                header("{$name}: {$sanitized_value}");
            } else {
                // ヘッダー設定に失敗した場合、ログに記録するか処理する
                // エラー処理によっては、例外をスローするか、デフォルトのまま続行できる
                http_response_code(500);
                if ($DEBUG)
                    print ("Failed setting header - original: '$value', sanitized: '$sanitized_value'");
                exit;
            }

            print ($renderer->getContent());
        }
    } catch (Exception $e) {
        http_response_code(500);
        print ("Internal error, please contact the admin.<br>");
        if ($DEBUG)
            print ($e->getMessage());
    }
} else {
    // 一致するルートがない場合、404エラー
    http_response_code(404);
    echo "404 Not Found: The requested route was not found on this server.";
}
