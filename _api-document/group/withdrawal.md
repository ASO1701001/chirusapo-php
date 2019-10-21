# グループ退会
> [POST] /group/withdrawal
## パラメーター

| Param | Require |
|:-:|:-:|
| token | Yes |
| group_id | Yes |
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
| UNKNOWN_GROUP | グループ情報が見つからない場合に返されます |
| VALIDATION_GROUP_ID | バリデーションに失敗した場合に返されます |
| UNREADY_BELONG_GROUP | グループに所属していない場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "UNKNOWN_GROUP",
        "VALIDATION_GROUP_ID",
        "UNREADY_BELONG_GROUP"
    ],
    "data": null
}
```