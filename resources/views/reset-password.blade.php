<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

</head>
<body>

 <!-- This is an example component -->
 <div class="login_form border-2 border-indigo-500 p-10 mt-24 pt-5 shadow-sm mx-auto flex rounded" style="width: 500px;">
    <form action="/update-password" method="POST" style="width: 500px;">
        @csrf
        @if (Session::get('reset'))
        <div class="flex text-center bg-none text-red text-md text-red-600 font-bold px-4 py-3" role="alert">
            <svg class="fill-current w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path
                    d="M12.432 0c1.34 0 2.01.912 2.01 1.957 0 1.305-1.164 2.512-2.679 2.512-1.269 0-2.009-.75-1.974-1.99C9.789 1.436 10.67 0 12.432 0zM8.309 20c-1.058 0-1.833-.652-1.093-3.524l1.214-5.092c.211-.814.246-1.141 0-1.141-.317 0-1.689.562-2.502 1.117l-.528-.88c2.572-2.186 5.531-3.467 6.801-3.467 1.057 0 1.233 1.273.705 3.23l-1.391 5.352c-.246.945-.141 1.271.106 1.271.317 0 1.357-.392 2.379-1.207l.6.814C12.098 19.02 9.365 20 8.309 20z" />
            </svg>
            <p>{{ Session::get('reset') }}</p>
        </div>
    @endif
    <div class="sec flex-1">
        {{-- <input type="hidden" name="token" value="{{$token}}"> --}}
        <img class="mb-5 mx-auto" style="width: 160px; height:150px; border-radius:50%;"
                    src="https://www.nj.com/resizer/h8MrN0-Nw5dB5FOmMVGMmfVKFJo=/450x0/smart/cloudfront-us-east-1.images.arcpublishing.com/advancelocal/SJGKVE5UNVESVCW7BBOHKQCZVE.jpg"
                    alt="">
        <span class="flex shadow-md mb-5 text-xs">
            <span class="bg-indigo-500 w-28 font-bold text-center text-gray-200 p-3 px-5 rounded-l">Password</span><input class="field text-sm text-gray-600 p-2 px-3 rounded-r w-full" type="text" name="password" placeholder="someonespecial@example.com">
        </span>

        <input type="hidden" name="id" value="{{$admin->id}}">
        <div class="text-red-500 -mt-2 p-0 text-sm"> @error('password'){{ $message }} @enderror</div>
        <span class="flex shadow-md mb-5 text-xs">
            <span class="bg-indigo-500 w-28 font-bold text-center text-gray-200 p-3 px-5 rounded-l">Confirm Password</span><input class="field text-sm text-gray-600 p-2 px-3 rounded-r w-full" type="password" name="confirm_password" placeholder="Enter your password" >
        </span>
        <div class="text-red-500 -mt-2 p-2 text-sm"> @error('confirm_password') {{ $message }}@enderror</div>
        <a class="text-indigo-500 hover:underline font-bold text-xs ml-auto cursor-pointer" href="/login">Already have an account</a>
        <span class="border-2 border-indigo-500 hover:bg-indigo-500 hover:text-gray-100 mt-3 text-indigo-500 block text-center p-3 px-4 text-sm rounded cursor-pointer font-bold"> <button type="submit"> Register </button></span>
    </div>
    </form>
</div>
</body>
</html>
