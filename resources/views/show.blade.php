<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            社員一覧
        </h2>
    </x-slot>

    <div class="mx-auto px-6">
        @foreach($users as $user)
            <div class="mt-4 text-lg font-semibold">
                <div class ="text-right">
                    <a href="{{route('profile.edit', $user)}}">
                        <x-primary-button>
                            編集
                        </x-primary-button>
                    </a>
                    <a href="{{route('profile.destroy', $user)}}">
                        <x-primary-button>
                            削除
                        </x-primary-button>
                    </a>
                </div>
                <h1 class="p-4 text-lg font-semibold">
                    {{$user->surname}} {{$user->given_name}}
                </h1>
                生年月日：{{$user->birth_day}}<br>
                電話番号：{{$user->phone}}
            <hr class="w-full">
            </div>
        @endforeach
    </div>
</x-app-layout>
