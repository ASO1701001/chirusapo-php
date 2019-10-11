# パスワードリセット
> [POST] /account/password-reset
## パラメーター
> このAPIは、user_idとしてメールアドレスを受け取ることが可能です

| Param | Require |
|:-:|:-:|
| user_id | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合、登録されているメールアドレスに仮パスワードが送信されます
```JSON
{
    "status": 200,
    "message": null,
    "data": null
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

| ErrorCode | Comment |
|:-:|:-:|
| REQUIRED_PARAM | 値が不足している場合に返されます<br>REQUIRED_PARAMが返された場合、バリデーション・登録チェックが行われることはありません |
| VALIDATION_USER_ID | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、ユーザー情報の検索が行われることはありません |
| UNKNOWN_USER | ユーザー情報が見つからない場合に返されます |
| MAIL_SEND | メール送信に失敗した場合に返されます<br>ただし、ライブラリの仕様上登録されているメールアドレスに届かなかった場合はstatusが200として返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "VALIDATION_USER_ID",
        "VALIDATION_PASSWORD",
        "UNKNOWN_USER",
    ],
    "data": null
}
```