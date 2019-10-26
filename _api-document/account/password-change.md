# パスワード変更
> [POST] /account/password-change
## パラメーター

| Param | Require |
|:-:|:-:|
| token | Yes |
| old_password | Yes |
| new_password | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合、パスワードが変更されます
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
| REQUIRED_PARAM | 値が不足している場合に返されます |
| VALIDATION_OLD_PASSWORD | バリデーションに失敗した場合に返されます |
| VALIDATION_NEW_PASSWORD | バリデーションに失敗した場合に返されます |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
| VERIFY_PASSWORD_FAILED | パスワードの検証に失敗した場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "VALIDATION_OLD_PASSWORD",
        "VALIDATION_NEW_PASSWORD",
        "UNKNOWN_TOKEN",
        "VERIFY_PASSWORD_FAILED"
    ],
    "data": null
}
```