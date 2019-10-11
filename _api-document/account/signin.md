# ログイン
> [POST] /account/signin
## パラメーター
> このAPIは、user_idとしてメールアドレスを受け取ることが可能です

| Param | Require |
|:-:|:-:|
| user_id | Yes |
| password | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合、ログイントークン・ユーザー基本情報・所属しているグループ情報を返します
> また、ユーザーアイコンが登録されていない場合、`data > user_info > user_icon` にはnullが返されます
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "token": "*token*",
        "user_info": {
            "user_id": "*user_id*",
            "user_name": "*user_name*",
            "email": "*email*",
            "user_icon": "*user_icon*"
        },
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
| REQUIRED_PARAM | 値が不足している場合に返されます<br>REQUIRED_PARAMが返された場合、バリデーション・登録チェックが行われることはありません |
| VALIDATION_USER_ID | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、ユーザー情報の検索が行われることはありません |
| VALIDATION_PASSWORD | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、ユーザー情報の検索が行われることはありません |
| UNKNOWN_USER | ユーザー情報が見つからない場合に返されます<br>ユーザーIDに一致する項目があり、パスワードが誤っている場合でもUNKNOWN_USERとして返されます |
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