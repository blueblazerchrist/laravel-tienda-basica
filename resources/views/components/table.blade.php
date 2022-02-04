<!-- This example requires Tailwind CSS v2.0+ -->
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                    <tr>
                        @foreach($columns as $column)
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            @if(is_array($column))
                                @if(array_values($column)[0] == 'img')
                                    {{ array_values($column)[1] }}
                                @else
                                    {{ array_values($column)[0] }}
                                @endif
                            @else
                                {{ $column }}
                            @endif
                        </th>
                        @endforeach
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Acciones
                        </th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($data as $info)
                        <tr>
                            @foreach($columns as $key => $column)
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        @if(is_array($column))
                                            @if(array_keys($column)[0] == 'img')
                                                <div class="flex-shrink-0 h-10 w-10">
                                                    <img class="h-10 w-10 rounded-full" src="{{ url('image-viewer',$info->{$key}) }}" alt="">
                                                </div>
                                            @else
                                                <div class="text-sm font-medium text-gray-900">{{ $info->{$key}->{array_keys($column)[0]} }}</div>
                                            @endif
                                        @else
                                            <div class="text-sm font-medium text-gray-900">{{ $info->{$key} }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            @endforeach
                            <td>
                                @foreach($actions as $route => $iconClass)
                                    <a class="cursor-pointer {{ array_keys($iconClass)[0] }} {{ $route }}" id="{{ $info->id }}"><i class="{{ array_values($iconClass)[0] }}"></i></a>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
