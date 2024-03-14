<?php

use Database\MySQLWrapper;

$mysqli = new MySQLWrapper();

function insertUserQuery(string $username, string $email, string $password, string $email_confirmed_at, string $created_at, string $updated_at): string
{
    return sprintf("
        INSERT INTO user (username, email, password, email_confirmed_at, created_at, updated_at)
        VALUES ('%s', '%s', '%s', '%s', '%s', '%s');
    ", $username, $email, $password, $email_confirmed_at, $created_at, $updated_at);
}

function insertPostQuery(string $title, string $content, string $created_at, string $updated_at): string
{
    return sprintf("
        INSERT INTO post (title, content, created_at, updated_at)
        VALUES ('%s', '%s', '%s', '%s');
    ", $title, $content, $created_at, $updated_at);
}

function insertCommentQuery(string $comment_text, string $created_at, string $updated_at): string
{
    return sprintf("
        INSERT INTO comment (comment_text, created_at, updated_at)
        VALUES ('%s', '%s', '%s');
    ", $comment_text, $created_at, $updated_at);
}

function insertPostLikeQuery(int $user_id, int $post_id): string
{
    return sprintf("
        INSERT INTO post_like (user_id, post_id)
        VALUES (%d, %d);
    ", $user_id, $post_id);
}
function
    insertCommentLikeQuery(
    int $user_id,
    int $comment_id
): string {
    return sprintf("
        INSERT INTO comment_like (user_id, comment_id)
        VALUES (%d, %d);
    ", $user_id, $comment_id);
}

function runQuery(mysqli $mysqli, string $query): void
{
    $result = $mysqli->query($query);
    if (!$result) {
        throw new Exception('クエリを実行できませんでした。');
    } else {
        print('クエリを実行しました。');
    }
}

runQuery(
    $mysqli,
    insertUserQuery(
        '新しいユーザー',
        '新しいユーザーのメールアドレス',
        '新しいユーザーのパスワード',
        '2024-01-01 00:00:00',
        '2024-01-01 00:00:00',
        '2024-01-01 00:00:00'
    )
);

runQuery(
    $mysqli,
    insertPostQuery(
        '新しい投稿',
        '新しい投稿の内容',
        '2024-01-01 00:00:00',
        '2024-01-01 00:00:00'
    )
);

runQuery(
    $mysqli,
    insertCommentQuery(
        '新しいコメント',
        '2024-01-01 00:00:00',
        '2024-01-01 00:00:00'
    )
);

runQuery(
    $mysqli,
    insertPostLikeQuery(1, 1)
);

runQuery(
    $mysqli,
    insertCommentLikeQuery(1, 1)
);

