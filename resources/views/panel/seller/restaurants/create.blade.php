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

            <div class="p-6 space-y-4 md:space-y-6 sm:p-8 form-container">
                <form class="space-y-4 ... ... md:space-y-6" action="{{ route('restaurant.store') }}" method="post">
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


                    <div class="form-group">
                        <label for="map_location" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">موقعیت
                            مکانی رستوران</label>
                        <button type="submit"
                                class="w-full text-black bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800"
                                formaction="{{ route('restaurant.location') }}" formmethod="post">انتخاب موقعیت مکانی از
                            روی نقشه
                        </button>
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
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">نوع رستوران را
                            انتخاب کنید</label>
                        @foreach($restaurantCategories as $restaurantCategory)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" id="restaurant_category_{{ $restaurantCategory->id }}"
                                       name="restaurant_category_ids[]" value="{{ $restaurantCategory->id }}"
                                       class="mr-2">
                                <label for="restaurant_category_{{ $restaurantCategory->id }}">
                                    {{ $restaurantCategory->name }}
                                </label>
                            </div>
                        @endforeach
                        @error('restaurant_category_ids')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="flex space-x-4">
                        <div class="flex flex-col">


                            <div class="form-group">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">انتخاب
                                    روزها</label>
                                @foreach (App\Enums\Day::getValues() as $key => $day)
                                    <div class="flex items-center mb-2">
                                        <input type="checkbox" id="day_{{ $key }}" name="selected_days[]"
                                               value="{{ $key }}" class="mr-2">
                                        <label for="day_{{ $key }}">
                                            {{ $day }}
                                        </label>
                                        <div class="flex space-x-4">
                                            <div class="flex flex-col">
                                                <label for="open_time_{{ $key }}"
                                                       class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    زمان شروع کار
                                                </label>
                                                <input type="time" id="open_time_{{ $key }}"
                                                       name="open_time[{{ $key }}]"
                                                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                />
                                            </div>
                                            <div class="flex flex-col">
                                                <label for="close_time_{{ $key }}"
                                                       class="mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    زمان پایان کار
                                                </label>
                                                <input type="time" id="close_time_{{ $key }}"
                                                       name="close_time[{{ $key }}]"
                                                       class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg
                                                focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5
                                                dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400
                                                dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @error('selected_days')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit"
                                    class="w-full text-black bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                ایجاد حساب
                            </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
</section>
