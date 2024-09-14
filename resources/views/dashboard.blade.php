<x-app-layout>
    <div class="flex gap-10">
        <div class="p-5 bg-blue-400 text-white">
            <h4>Total Number of Companies - <b>{{$total_company}}</b></h4>
        </div>
        <div class="p-5 bg-blue-400 text-white">
            <h4>Total Number of Employees - <b>{{$total_employee}}</b></h4>
        </div>
    </div>
    <div class="my-5">
        <h4 class="text-xl text mb-4">Recent Created Companies</h4>
        <ul>
            @foreach ($recent_companies as $company)
                <li class="p-2 border">{{$company->name}}</li>
            @endforeach
        </ul>
    </div>
</x-app-layout>
