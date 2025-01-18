@props([
    'id' => 0, // ID
    'reservation_name' => '', // 作業詳細
    'user_select_data' => (object) [],
    'selected_reservation_task_id' => 0,
])

<div class="hidden reservation-task-item" data-user_select_data="{{ json_encode($user_select_data, true) }}">
    <div class="grid grid-cols-4 grid-rows-1 gap-4 items-center text-xs font-bold">
        <label for="reservation-tasks-input-{{ $id }}"
            class="col-span-3 flex gap-3 items-center justify-start cursor-pointer">
            <input type="radio" class="hidden-radio step-radio reservation-task-radio" name="reservation_task_id"
                value="{{ $id }}" id="reservation-tasks-input-{{ $id }}"
                {{ $selected_reservation_task_id == $id ? 'checked' : '' }}>
            <div class="step-border border border-red-700 px-1 py-2">
                <span class="check-icon input-type-check">
                    <img src="{{ Vite::asset('resources/img/top/button_check.png') }}" alt="チェック" class="w-4">
                </span>
            </div>
            <span class="text-clip">{{ $reservation_name }}</span>
        </label>
        <div class="col-start-4 text-red-600 font-bold px-2 text-right inline-block">
            <span class="step04-details hidden sm:inline-block border-b border-red-600 cursor-pointer"
                data-task-id="{{ $id }}">さらに詳しく</span>
            <img src="{{ Vite::asset('resources/img/top/learn_more.png') }}" alt="さらに詳しく"
                class="step04-details inline-block sm:hidden w-5 ms-auto cursor-pointer"
                data-task-id="{{ $id }}">
        </div>
    </div>
    <hr class="my-2 border-1 border-red-600">
</div>
