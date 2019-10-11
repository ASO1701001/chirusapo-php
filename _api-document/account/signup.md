# アカウント登録
> [POST] /account/signup
## パラメーター
| Param | Require |
|:-:|:-:|
| user_id | Yes |
| user_name | Yes |
| email | Yes |
| password | Yes |
| gender | Yes |
| birthday | Yes |
## レスポンス
### 成功時
> このAPIは成功した場合、ログイントークン・ユーザー基本情報を返します
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
        }
    }
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

| ErrorCode | Comment |
|:-:|:-:|
| REQUIRED_PARAM | 値が不足している場合に返されます<br>REQUIRED_PARAMが返された場合、バリデーション・重複チェックが行われることはありません |
| VALIDATION_USER_ID | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、重複チェックが行われることはありません |
| VALIDATION_USER_NAME | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、重複チェックが行われることはありません |
| VALIDATION_EMAIL | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、重複チェックが行われることはありません |
| VALIDATION_PASSWORD | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、重複チェックが行われることはありません |
| VALIDATION_GENDER | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、重複チェックが行われることはありません |
| VALIDATION_BIRTHDAY | バリデーションに失敗した場合に返されます<br>VALIDATION_*が返された場合、重複チェックが行われることはありません |
| ALREADY_USER_ID | 既にユーザーIDが登録されている場合に返されます |
| ALREADY_EMAIL | 既にメールアドレスが登録されている場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "VALIDATION_USER_ID",
        "VALIDATION_USER_NAME",
        "VALIDATION_EMAIL",
        "VALIDATION_PASSWORD",
        "VALIDATION_GENDER",
        "VALIDATION_BIRTHDAY",
        "ALREADY_USER_ID",
        "ALREADY_EMAIL"
    ],
    "data": null
}
```