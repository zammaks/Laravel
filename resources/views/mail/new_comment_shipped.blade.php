<x-mail::message>
 Для статьи 
 #"{{$article_name}}" 
 добавлен комментарий с текстом: 
{{$comment->desc}}
<!-- <x-mail::panel>
    
</x-mail::panel> -->

<!-- The body of your message. -->

<x-mail::button :url="$url">
Accept
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
