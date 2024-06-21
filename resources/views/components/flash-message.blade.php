@if(session()->has('message'))
    <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show" class=" top-0 text-white left-0 flex items-center justify-center bg-blue-600 px-48 py-3">
        <p>
            {{session('message')}}
        </p>
    </div>
@endif
