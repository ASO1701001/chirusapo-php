# タイムライン投稿
> [POST] /timeline/post
## パラメーター

|   Param  | Require |
|:--------:|:-------:|
|   token  |   Yes   |
| group_id |   Yes   |
|  content |    No   |
|  image01 |    No   |
|  image02 |    No   |
|  image03 |    No   |
|  image04 |    No   |
|  movie01 |    No   |
## レスポンス
### 成功時
> このAPIは成功した場合、投稿情報を返します
```JSON
{
    "status": 200,
    "message": null,
    "data": {
        "post_data": {
            
        }
    }
}
```
### 失敗時
> このAPIは失敗した場合、以下のエラーを返します

|             ErrorCode            |                              Comment                             |
|:--------------------------------:|:----------------------------------------------------------------:|
|          REQUIRED_PARAM          |                 値が不足している場合に返されます                 |
|       NOT_FIND_POST_CONTENT      |      投稿しようとしている情報が見つからない場合に返されます      |
|       DUPLICATE_MEDIA_FILE       |    画像と動画を同時にアップロードしようとした場合に返されます    |
|          ALLOW_EXTENSION         | アップロードできないファイルがアップロードされた場合に返されます |
|        GENERATE_THUMBNAIL        |         動画のサムネイルの生成に失敗した場合に返されます         |
|        VALIDATION_GROUP_ID       |             バリデーションに失敗した場合に返されます             |
| VALIDATION_TIMELINE_POST_CONTENT |             バリデーションに失敗した場合に返されます             |
|           UNKNOWN_TOKEN          |         ログイントークンの検証に失敗した場合に返されます         |
| UNKNOWN_GROUP                    | グループ情報が見つからない場合に返されます                       |
| UNREADY_BELONG_GROUP             | グループに所属していない場合に返されます                         |
| UPLOAD_FAILED                    | アップロードに失敗した場合に返されます                           |
``` JSON
{
    "status": 400,
    "message": [
        "REQUIRED_PARAM",
        "NOT_FIND_POST_CONTENT",
        "DUPLICATE_MEDIA_FILE",
        "ALLOW_EXTENSION",
        "GENERATE_THUMBNAIL",
        "VALIDATION_GROUP_ID",
        "VALIDATION_TIMELINE_POST_CONTENT",
        "UNKNOWN_TOKEN",
        "UNKNOWN_GROUP",
        "UNREADY_BELONG_GROUP",
        "UPLOAD_FAILED"
    ],
    "data": null
}
```