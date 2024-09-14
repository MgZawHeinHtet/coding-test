@props(['type', 'company' => null])
<h2 class="mb-4 text-xl font-bold text-gray-900 ">Company {{$type}}</h2>

<form action="{{ $type === 'create' ? '/dashboard/company' : '/dashboard/company/' . $company?->id }}" method="POST"
    enctype="multipart/form-data">
    @csrf
    @if ($type === 'edit')
        @method('PATCH')
    @endif

    <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
        <div class="sm:col-span-2">
            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 ">Company
                Name</label>
            <input type="text" name="name" id="name" value="{{ old('name', $company?->name) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5  "
                placeholder="Type company name">
            <x-error name="name"></x-error>
        </div>

        <div class="sm:col-span-2">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 ">Company
                Email</label>
            <input type="text" name="email" id="email" value="{{ old('email', $company?->email) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.5 "
                placeholder="Type your email">
            <x-error name="email"></x-error>
        </div>

        <div>
            <label class="block mb-2 text-sm font-medium text-gray-900 " for="default_size">Logo</label>
            <input name="logo"
                class="block w-full mb-5 text-sm p-2 text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 "
                id="default_size" type="file">
            <x-error name="logo"></x-error>
            @if ($type === 'edit')
                <img width="100" height="100" class="object-contain" src="{{ $company?->logo }}" alt="">
            @endif
        </div>

        <div class="sm:col-span-2">
            <label for="website" class="block mb-2 text-sm font-medium text-gray-900">Website
                Name</label>
            <input type="text" name="website" id="website" value="{{ old('website', $company?->website) }}"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-600 focus:border-green-600 block w-full p-2.50 "
                placeholder="Enter your website link">
            <x-error name="website"></x-error>
        </div>

       
    </div>
    <button type="submit"
        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-green-700 rounded-lg focus:ring-4 focus:ring-green-200  hover:bg-green-800">
        {{ $type === 'edit' ? 'Save' : 'Create' }}
    </button>
</form>
