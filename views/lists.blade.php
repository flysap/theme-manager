<a href="{{route('theme-upload')}}">{{_("Upload theme")}}</a>

<table>
    <thead>
    <tr>
        <td>{{_("Name")}}</td>
        <td>{{_("Description")}}</td>
        <td>{{_("Version")}}</td>
    </tr>
    </thead>

    @foreach($themes as $theme)
        <tr>
            <td>{{$theme['name']}}</td>
            <td>{{$theme['description']}}</td>
            <td>{{$theme['version']}}</td>
            <td colspan="2">
                <a href="{{route('theme-remove', str_replace('/', '-', $theme['name']))}}">rm</a>
            </td>
        </tr>
    @endforeach
</table>