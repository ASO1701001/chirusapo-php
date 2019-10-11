# ログイン
> [POST] /group/create
## パラメーター

| Param | Require |
|:-:|:-:|
| token | Yes |
| group_id | Yes |
| group_name | Yes |
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
                "group_name": "*group_name*", 
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
| VALIDATION_GROUP_ID | バリデーションに失敗した場合に返されます |
| VALIDATION_GROUP_NAME | バリデーションに失敗した場合に返されます |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
| ALREADY_CREATE_GROUP | 既にグループIDが登録されている場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "VALIDATION_GROUP_ID",
        "VALIDATION_GROUP_NAME",
        "UNKNOWN_TOKEN",
        "ALREADY_CREATE_GROUP"
    ],
    "data": null
}
```