# 所属グループ取得
> [POST] /group/belong-group
## パラメーター

| Param | Require |
|:-:|:-:|
| token | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合、所属しているグループ情報を返します

```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "belong_group": [
            {
                "group_id": "*group_id*",
                "group_name": "*group_name*"
            }
        ]
    }
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

| ErrorCode | Comment |
|:-:|:-:|
| REQUIRED_PARAM | 値が不足している場合に返されます |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
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