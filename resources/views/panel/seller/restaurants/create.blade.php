@extends('layouts.auth')

<section class="bg-gray-50 dark:bg-gray-900 text-end">
    <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
        <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
            <img class="w-8 h-8 mr-2"
                 src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS-TZASdttiWEg6PCoxneJY8hxYljizD-8qIB0mfzwG0ENFn2yBpurecB5UARNog3mdCl0&usqp=CAU"
                 alt="logo">
            تکمیل اطلاعات رستوران
        </a>
        <div
            class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
    <form class=" space-y-4 md:space-y-6" action="{{ route('restaurant.store') }}" method="post">
                    @csrf
                    <div>
                        <label for="restaurant_name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نام
                            رستوران</label>
                        <input type="text" name="restaurant_name" id="restaurant_name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="نام رستوران">
                        @error('restaurant_name')
                        <p class="text-red-800 text-xl">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره
                            تماس رستوران</label>
                        <input type="text" name="phone" id="phone"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="0.......">
                        @error('phone')
                        <p class="text-red-800 text-xl">{{ $message }}</p>
                        @enderror
                    </div>


                    <div>
                        <label for="credit_card_number"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">شماره
                            حساب رستوران</label>
                        <input type="text" name="credit_card_number" id="credit_card_number"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="............">
                        @error('credit_card_number')
                        <p class="text-red-800 text-xl">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">آدرس
                            رستوران</label>
                        <input type="text" name="address" id="address" placeholder="آدرس رستوران"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                        @error('address')
                        <p class="text-red-800 text-xl">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <label for="send_cost" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            هزینه ارسال</label>
                        <input type="text" name="send_cost" id="send_cost" placeholder="هزینه ارسال به تومان"
                               class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        >
                        @error('send_cost')
                        <p class="text-red-800 text-xl">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="restaurant_category_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع
                            رستوران را انتخاب کنید</label>
                        <select id="restaurant_category_id" name="restaurant_category_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>نوع رستوران</option>
                            @foreach($restaurantCategories as $restaurantCategory)
                                <option
                                    value="{{ $restaurantCategory->id }}">{{ $restaurantCategory->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>





        <div class="form-group flex flex-col">
            <label for="open_time" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">زمان شروع کار رستوران</label>
            <input
                value="{{ old('open_time-at') }}"
                type="time"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="open_time"
                name="open_time"
                placeholder="Enter open time"
            />
            @error('open_time')
            <p class="text-red-800 text-xl">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group flex flex-col">
            <label for="close_time" class="mb-2 text-sm font-medium text-gray-900 dark:text-white">زمان پایان کار رستوران</label>
            <input
                value="{{ old('close_time') }}"
                type="time"
                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                id="close_time"
                name="close_time"
                placeholder="Enter close time"
            />
            @error('close_time')
            <p class="text-red-800 text-xl">{{ $message }}</p>
            @enderror
        </div>






        {{--        <div class="form-group">--}}
{{--            <label for="open_time">open time at</label>--}}
{{--            <input--}}
{{--                value="{{ old('open_time-at') }}"--}}
{{--                type="datetime-local"--}}
{{--                class="form-control @error('open_time') is-invalid @enderror"--}}
{{--                id="open_time"--}}
{{--                name="open_time"--}}
{{--                placeholder="Enter open time"--}}
{{--            />--}}
{{--            @error('open_time')--}}
{{--            <div class="alert alert-danger">{{ $message }}</div>--}}
{{--            @enderror--}}
{{--        </div>--}}
{{--        <div class="form-group">--}}


{{--            <div class="form-group">--}}
{{--                <label for="close_time">close time at</label>--}}
{{--                <input--}}
{{--                    value="{{ old('close_time') }}"--}}
{{--                    type="datetime-local"--}}
{{--                    class="form-control @error('close_time') is-invalid @enderror"--}}
{{--                    id="close_time"--}}
{{--                    name="close_time"--}}
{{--                    placeholder="Enter close time"--}}
{{--                />--}}
{{--                @error('close_time')--}}
{{--                <div class="alert alert-danger">{{ $message }}</div>--}}
{{--                @enderror--}}
{{--            </div>--}}
{{--            <div class="form-group">--}}





            <button type="submit"
                            class="w-full text-black bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        ایجاد حساب
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
