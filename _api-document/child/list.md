# 子ども情報一覧取得
> [GET] /child/list
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| group_id |   Yes   |
## レスポンス
### 成功時
> このAPIは成功した場合、子ども情報一覧を返します    
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "child_list": [
             {
                 "user_id": "*user_id*",
                 "user_name": "*user_name*",
                 "birthday": "*birthday*",
                 "age": "*age*",
                 "gender": "*gender*",
                 "blood_type": "*blood_type*",
                 "user_icon": "*user_icon*",
                 "body_height": "*body_height*",
                 "body_weight": "*body_weight*",
                 "clothes_size": "*clothes_size*",
                 "shoes_size": "*shoes_size*",
                 "vaccination": [
                     {
                         "id": "*id*",
                         "vaccine_name": "*vaccine_name*",
                         "visit_date": "*visit_date*"
                     }
                 ],
                 "allergy": [
                     {
                         "id": "*id*",
                         "allergy_name": "*allergy_name*"
                     }
                 ]
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
| UNREADY_BELONG_GROUP | グループに所属していない場合に返されます |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "UNKNOWN_TOKEN",
        "UNKNOWN_GROUP",
        "UNREADY_BELONG_GROUP"
    ],
    "data": null
}
```