# グループ参加
> [POST] /group/join
## パラメーター

| Param | Require |
|:-:|:-:|
| token | Yes |
| group_id | Yes |
| pin_code | Yes |
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
| VALIDATION_PIN_CODE | バリデーションに失敗した場合に返されます |
| UNKNOWN_TOKEN | ログイントークンの検証に失敗した場合に返されます |
| UNKNOWN_GROUP | 参加しようとしているグループ情報が見つからない場合に返されます |
| ALREADY_BELONG_GROUP | 既にグループに参加している場合に返されます |
| VERIFY_PIN_CODE | PINコードが誤っている場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "VALIDATION_GROUP_ID",
        "VALIDATION_PIN_CODE",
        "UNKNOWN_TOKEN",
        "UNKNOWN_GROUP",
        "ALREADY_BELONG_GROUP",
        "VERIFY_PIN_CODE"
    ],
    "data": null
}
```