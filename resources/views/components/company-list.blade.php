@props(['employee'=>null])

<div>
    <label for="Company" class="block mb-2 text-sm font-medium text-gray-900 ">Company</label>
    <select id="Company" name="company_id"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-green-500 focus:border-green-500 block w-full p-2.5 ">
        <option disabled selected="">Select Company</option>
        @foreach ($companies as $company)
            <option {{ $company->id == old('company_id',$employee?->company_id) ? 'selected' : '' }} value="{{ $company->id }}">
                {{ $company->name }}</option>
        @endforeach

    </select>
    <x-error name="company_id"></x-error>
</div>
