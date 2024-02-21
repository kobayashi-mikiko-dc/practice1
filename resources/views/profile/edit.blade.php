<x-guest-layout>
    <form method="POST" action="{{ route('profile.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <?php
        //dd($user->id);
        ?>
        <!-- Name -->
        <div>
            <x-input-label for="surname" :value="__('姓')" />
            <x-text-input id="surname" class="block mt-1 w-full" type="text" name="surname" :value="old('surname', $user->surname)" required autofocus autocomplete="surname" />
            <x-input-error :messages="$errors->get('surname')" class="mt-2" />

            <x-input-label for="given_name" :value="__('名')" />
            <x-text-input id="given_name" class="block mt-1 w-full" type="text" name="given_name" :value="old('given_name', $user->given_name)" required autofocus autocomplete="given_name" />
            <x-input-error :messages="$errors->get('given_name')" class="mt-2" />
        </div>
        <div class="mt-4">
            <img src="{{ asset('storage/img/' .  $user->image_file_name) }}">
            <input type="file" name="image_file_name">
            <x-input-error :messages="$errors->get('image_file_name')" class="mt-2" />
            <button>アップロード</button>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('メールアドレス')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $user->email)" required autocomplete="email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <?php 
        $strDate = explode("-",$user->birth_day);
        $date = array_map('intval', $strDate);
        $userYear = $date[0];
        $userMonth = $date[1];
        $userDay = $date[2];
      
        ?>
        <!-- birth day -->
        <div class="mt-4">      
            <select id="year" name="year" class="form-select">
                <option value="">{{$userYear}}</option>
                @foreach(MyFunction::yearSelect() as $year)
                    <option value="{{ $year }}">{{ old('year', $userYear) == $year ? 'selected' : '' }}{{ $year }}</option>
                @endforeach
                
            </select>
            <label for="year">年</label>

            <select id="month" name="month" class="form-select">
                <option value="">{{$userMonth}}</option>
                @foreach(MyFunction::monthSelect() as $month)
                    <option value="{{ $month }}">{{ old('month', $userMonth) == $month ? 'selected' : '' }}{{ $month }}</option>
                @endforeach
                
            </select>
            <label for="month">月</label>

            <select id="day" name="day" class="form-select">
                <option value="">{{$userDay}}</option>
                @foreach(MyFunction::daySelect() as $day)
                    <option value="{{ $day }}">{{ old('day', $userDay) == $day ? 'selected' : '' }}{{ $day }}</option>
                @endforeach
                
            </select>
            <label for="day">日</label>
        </div>

    
        <!-- phone number -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('電話番号')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone', $user->phone)" required autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('パスワード')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('パスワード（確認用）')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ms-4">
                {{ __('更新') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
