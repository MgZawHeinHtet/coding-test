<x-app-layout>
    <div>
        <div class="bg-gray-400 p-3 mb-5 flex justify-between items-center">
            <h5>Total Companies - {{$companies->count()}}</h5>
            <div class="flex gap-3 items-center ">
                <form >
                    <input name="search" value="{{request('search')}}" class="rounded-xl bg-white" placeholder="search by everything" />
                    <select name="filter" class="rounded-xl" onchange="this.form.submit()">
                        <option>Filter by Created Date</option>
                        <option {{request('filter') === "last-day" ? 'selected' : ''}} value="last-day">Last Day</option>
                        <option {{request('filter') === "7-days" ? 'selected' : ''}} value="7-days">7 Days</option>
                        <option {{request('filter') === "last-month" ? 'selected' : ''}} value="last-month">Last Month</option>
                       
                    </select>
                </form>
                <form action="company/create">
                    @csrf
                    <button class="py-2 px-5 text-white rounded-lg bg-gray-700">Add Company</button>
                </form>
            </div>

        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Company name
                    </th>
                    <th scope="col" class=" px-6 py-3">
                        Email
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Logo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Website
                    </th>


                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if ($companies->count())

                @foreach ($companies as $company)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">


                    <td class="px-4 py-4">
                        <span class="line-clamp-2">
                            {{ $company->name }}
                        </span>
                    </td>
                    <td class="px-6 py-4 ">
                        {{$company->email}}
                    </td>
                    <td class="px-6 py-4">
                        <img class="w-20 h-20 rounded-[50%] object-cover" src="{{$company->logo}}">
                    </td>
                    <td class="px-6 py-4">
                        {{ $company->website}}
                    </td>

                    <td class="px-6 py-4">
                        <div class="flex items-center">
                            <a href="/dashboard/company/{{ $company->id }}/edit" class="font-medium mr-3 text-green-600 dark:text-green-500 hover:underline">Edit</a>
                            <form action="/dashboard/company/{{ $company->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-red-500 hover:underline">Delete</button>
                            </form>
                        </div>

                    </td>
                </tr>
                @endforeach
                @else
                <tr class="w-full h-[600px]">
                    <td colspan="8" class="text-center text-lg tracking-wider">No Items found 🤷‍♀️</td>
                </tr>
                @endif
            </tbody>

        </table>
        <div class="paginator mt-5">
            {{ $companies->links() }}
        </div>
    </div>
</x-app-layout>
