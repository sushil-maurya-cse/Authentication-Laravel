
Hi {{$details['name']}},

There was a request to change your password!<br>

If you did not make this request then please ignore this email.<br>
{{$id = Crypt::encryptString($details['id'])}}
{{-- {{$details['id']}} --}}
Otherwise, please click this link to change your password: http://127.0.0.1:8000/reset-password/{{$id}}<br>
