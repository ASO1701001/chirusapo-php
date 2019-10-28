# 退会
> [POST] /account/resign
## パラメーター
| Param | Require |
|:-:|:-:|
| token | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合アカウントが無効化されトークンが削除されます
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
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN"
    ],
    "data": null
}
```