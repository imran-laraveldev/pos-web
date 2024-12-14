<?php
if (!function_exists('UserMenu')) {
    function UserMenu($activeRouteName = '/')
    {
        $navs = (new \App\Services\UtilityService())->getUserMenu();
//        var_dump(implode(',',array_column($navs,'name')));
        $menuHtml = '';
        if (sizeof($navs)) {
            foreach ($navs as $nav) {
                $routeExist = \Illuminate\Support\Facades\Route::has($nav->slug);
//                echo  $nav->slug . ': '. $routeExist . '<br/>';
                if ($routeExist) {
                    if ($nav->children->count() >= 1) {
                        $slugArray = $nav->children->pluck('slug')->toArray();
                        /*$isParentActive = in_array($activeRouteName, $slugArray) ? 'menuitem-active show' : '';
                        $collapseShow = in_array($activeRouteName, $slugArray) ? 'collapse in show' : 'collapse';
                        $menuHtml .= '<li class="side-nav-item sub_menu ' . $isParentActive . '" data-toggle="collapse" href="#submenu-' . $nav->id . '" role="button" aria-expanded="false" aria-controls="submenu-' . $nav->id . '">
                        <a href="javascript:;" class="side-nav-link" ><i class="' . $nav->icon . '"></i><span>' .
                            $nav->name . '</span></a><ul class="list-group ' . $collapseShow . ' ps-4 bg-light" id="submenu-' . $nav->id . '">';

                        foreach ($nav->children as $index => $row) {
                            if (\Illuminate\Support\Facades\Route::has($row->slug)) {
                                $isActive = in_array($activeRouteName, [$row->slug]) ? 'active' : '';
                                $menuHtml .= '<li class="list-group-item ' . $isActive . ' border-0 bg-light py-1"><a href="' . route($row->slug) . '" ' .
                                    'style="text-decoration: none !important;" class="d-block text-dark"><i class="uil-angle-double-right"></i>' . $row->name . '</a></li>';
                            }
                        }
                        $menuHtml .= '</ul></li>';*/

                        $isParentActive = in_array($activeRouteName, $slugArray) ? '' : 'collapsed';
                        $collapseShow = in_array($activeRouteName, $slugArray) ? 'collapse show' : 'collapse';
                        $menuHtml .= '<li class="nav-item">
                                        <a class="nav-link menu-link ' . $isParentActive . '" href="#sidebar' . $nav->slug . '" data-bs-toggle="collapse" role="button"
                                           aria-expanded="false" aria-controls="sidebar' . $nav->slug . '">
                                            <i class="' . $nav->icon . ' ri-dashboard-2-line"></i> <span data-key="t-' . $nav->slug . '">' . $nav->name . '</span>
                                        </a>
                                        <div class="menu-dropdown '.$collapseShow.'" id="sidebar' . $nav->slug . '">
                                            <ul class="nav nav-sm flex-column">';
                        foreach ($nav->children as $index => $row) {
                            $route = route('home');
                            if (\Illuminate\Support\Facades\Route::has($row->slug)) {
                                $route = route($row->slug,$row->dynamic_form_id);
                            }

                            $menuHtml .= '      <li class="nav-item">
                                                    <a href="' . $route . '" class="nav-link" data-key="t-analytics"> ' . $row->name . ' </a>
                                                </li>';
                        }
                        $menuHtml .= '      </ul>
                                        </div>
                                    </li>';
                    } else {
                        $isActive = ($activeRouteName == $nav->slug) ? 'active' : '';
                        $menuHtml .= '<li class="nav-item">
                                        <a class="nav-link menu-link ' . $isActive . '" href="' . route($nav->slug) . '" role="button"
                                            >
                                            <i class="' . $nav->icon . '"></i> <span data-key="t-' . $nav->slug . '">' . $nav->name . '</span>
                                        </a>
                                      </li>';

                    }
                }
            }
        }
        return $menuHtml;
    }
}

if (!function_exists('UserMenu2')) {
    function UserMenu2()
    {
        $navs = (new \App\Services\UtilityService())->getUserMenu();
        $menuHtml = '';
        foreach ($navs as $nav) {
            $menuHtml .= '<li role="presentation" class="">
                            <a href="' . \Illuminate\Support\Facades\URL::asset($nav->slug) . '" aria-controls="approved" aria-expanded="true">' . $nav->name . '</a></li>';
        }
        return $menuHtml;
    }
}

if (!function_exists('dropdownOptions')) {
    function dropdownOptions($options = [], $selected = FALSE, $noKeys = FALSE, $skipFirst = true)
    {
        $str = '';
        if ($skipFirst) {
            $str .= '<option value="">Please Select</option>';
        }
        if (!empty($options)) {
            foreach ($options as $option) {
                if ($noKeys) {
                    $sel = ($option == $selected) ? ' selected ' : '';
                    $str .= '<option value="' . $option . '" ' . $sel . '>' . ucfirst(str_replace('_', ' ', $option)) . '</option>';
                } else {
                    $optionText = isset($option['title']) ? $option['title'] : $option['name'];
                    $sel = ($option['id'] == $selected) ? ' selected ' : '';
                    $str .= '<option value="' . $option['id'] . '" ' . $sel . '>' . ucfirst(str_replace('_', ' ', $optionText)) . '</option>';
                }
            }
        }
        return $str;
    }
}

if (!function_exists('selectOptions')) {
    function selectOptions($options = [], $selected = FALSE, $noKeys = FALSE, $skipFirst = true)
    {
        $str = '';
        if ($skipFirst) {
            $str .= '<option value="">Please Select</option>';
        }
        if (!empty($options)) {
            foreach ($options as $option) {
                if ($noKeys) {
                    $sel = ($option == $selected) ? ' selected ' : '';
                    $str .= '<option value="' . $option . '" ' . $sel . '>' . ucfirst(str_replace('_', ' ', $option)) . '</option>';
                } else {
                    $optionText = isset($option['title']) ? $option['title'] : $option['name'];
                    $sel = ($option['id'] == $selected) ? ' selected ' : '';
                    $str .= '<option value="' . $option['id'] . '" ' . $sel . '>' . ucfirst(str_replace('_', ' ', $optionText)) . '</option>';
                }
            }
        }
        echo $str;
    }
}

if (!function_exists('selectOptionsWithObject')) {
    function selectOptionsWithObject($options = [], $selected = FALSE, $noKeys = FALSE, $skipFirst = true)
    {
        $str = '';
        if ($skipFirst) {
            $str .= '<option value="">Please Select</option>';
        }
        if (!empty($options)) {
            foreach ($options as $option) {
                if ($noKeys) {
                    $sel = ($option == $selected) ? ' selected ' : '';
                    $str .= '<option value="' . $option . '" ' . $sel . '>' . ucfirst(str_replace('_', ' ', $option)) . '</option>';
                } else {
                    $optionText = isset($option->title) ? $option->title : $option->name;
                    $sel = ($option->id == $selected) ? ' selected ' : '';
                    $str .= '<option value="' . $option->id . '" ' . $sel . '>' . ucfirst(str_replace('_', ' ', $optionText)) . '</option>';
                }
            }
        }
        return $str;
    }
}

function base64url_encode($data)
{
    return generate_string(30) . rtrim(strtr(base64_encode($data), '+/', '-_'), '=') . generate_string(30);
}

function base64url_decode($data)
{
    $str_start = substr($data, 0, 30);
    $str_end = substr($data, -30);
    $find = array($str_start, $str_end);
    $rep = array('', '');
    $data = str_replace($find, $rep, $data);
    return base64_decode(str_pad(strtr($data, '-_', '+/'), strlen($data) % 4, '=', STR_PAD_RIGHT));
}

function generate_string($strength = 30, $integer = '')
{
    if ($integer == 1) {
        $input = '0123456789';
    } else {
        $input = '0123456789!@#$&abcdefghijklmnopqrstuvwxyz!@#$&ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$&';
    }

    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }

    return $random_string;
}

function hasPermission($permission)
{
    $roles = Auth::user()->roles->pluck('id');
    $role_id = $roles[0];
    if ($role_id == 1 || $role_id == 2) {
        return true;
    }

    $role = Spatie\Permission\Models\Role::find($role_id);
    if ($role != null) {
        try {
            return $role->hasPermissionTo($permission);
        } catch (Exception $e) {
            return false;
        }
    } else {
        return false;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin()
    {
        $role_id = Session::get('user_info.role_id');
        if ($role_id == 1 || $role_id == 5) {
            return true;
        }
        return false;
    }
}

if (!function_exists('isManager')) {
    function isManager()
    {
        return \Illuminate\Support\Facades\Auth::user()->hasRole('Manager');
    }
}

function uiDateFormat($date) {
    return date('d M Y', strtotime($date));
}

function get_initial($str, $length=false){
    $acronym = '';
    $word = '';
    $words = preg_split("/(\s|\-|\.)/", $str);
    if (sizeof($words) > 1) {
        foreach ($words as $w) {
            $acronym .= substr($w, 0, 1);
        }
        if ($length) {
            $acronym = substr($acronym, 0, $length);
        }
    } else {
        $acronym = $words[0];
    }
    $word = $word . $acronym ;
    return $word;
}

if (!function_exists('daysCount')) {

    function daysCount($fdate, $tdate)
    {
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        return $interval->format('%a');
    }
}

if (!function_exists('renderImageFile')) {
    function renderImageFile($ext, $path, $width = '50px', $iconOnly = false, $faSize = 'fa-2x')
    {
        $return = "";
        if (strtolower($ext) == "xls" || strtolower($ext) == "xlsx") {
            $return = "<a href='$path'>
            <i class='fa fa-file-excel-o $faSize pull-left'></i>
        </a>";
        } elseif (strtolower($ext) == "doc" || strtolower($ext) == "docx") {
            $return = "<a href='$path'>
            <i class='fa fa-file-word-o $faSize pull-left'></i>
        </a>";

        } elseif (strtolower($ext) == "pdf") {
            $return = "<a href='$path'>
            <i class='fa fa-file-pdf-o $faSize  pull-left'></i>
        </a>";
        } elseif (strtolower($ext) == "txt") {
            $return = "<a href='$path'>
            <i class='fa fa-file-text-o $faSize pull-left'></i>
        </a>";
        } elseif (strtolower($ext) == "jpg" || strtolower($ext) == "jpeg" || strtolower($ext) == "png" || strtolower($ext) == "jfif") {
            if ($iconOnly) {
                $return = "<a href='' src='$path' class='modalShow'><i class='fas fa-fw fa-image " . $faSize . " pull-left'></i></a>";
            } else {
                $return = "<img src='$path' class='modalShow pull-left' style='width:$width; cursor:pointer;padding:10px;'>";
            }
        }
        return $return;
    }
}

if (!function_exists('divisionDropDown')) {
    function divisionDropDown($province_id, $selected = '')
    {
        $str = '<option value="0">Please Select</option>';
        if (!is_null($province_id)) {
            $query = \App\Models\Division::where('div_province_idfk', $province_id);

            $divisions = $query->get();
        } else {
            $divisions = \App\Models\Division::all();
        }
        if (!empty($divisions)) {
            foreach ($divisions as $row) {
                $sel = ($row['div_id'] == $selected) ? ' selected ' : '';
                $str .= '<option value="' . $row['div_id'] . '" ' . $sel . '>' . ucfirst($row['div_name']) . '</option>';
            }
        }

        return $str;
    }
}

if (!function_exists('districtDropDown')) {
    function districtDropDown($divisionID, $selected = '')
    {
        $str = '<option value="0">Please Select</option>';
        if (!is_null($divisionID)) {
            $query = \App\Models\District::where('division_idfk', $divisionID);
            //check for exclude a specific district
            if (Session::get('user_info.other_district_excluded') != null) {
                $query->where(function ($query) {
                    $query->whereNotIn('id', explode(',', Session::get('user_info.other_district_excluded')));
                });
            }

            if (Session::get('user_info.other_district_included') != null) {

                $query->where(function ($query) {
                    $query->whereIn('id', explode(',', Session::get('user_info.other_district_included')));
                });
            }

            if (Session::get('user_info.district_id') != null) {
                $query->where(function ($query) {
                    $query->whereIn('id', explode(',', Session::get('user_info.district_id')));
                });
            }

            $dists = $query->get();
        } else {
            $dists = \App\Models\District::all();
        }

        if (!empty($dists)) {
            foreach ($dists as $dist) {
                $sel = ($dist['id'] == $selected) ? ' selected ' : '';
                $str .= '<option value="' . $dist['id'] . '" ' . $sel . '>' . ucfirst($dist['name']) . '</option>';
            }
        }

        return $str;
    }
}


if (!function_exists('convertToCamelCase')) {
    function convertToCamelCase($value, $encoding = null) {
        if ($encoding == null){
            $encoding = mb_internal_encoding();
        }
        $stripChars = "()[]{}=?!.:,-_+\"#~/";
        $len = strlen( $stripChars );
        for($i = 0; $len > $i; $i ++) {
            $value = str_replace( $stripChars [$i], " ", $value );
        }
        $value = mb_convert_case( $value, MB_CASE_TITLE, $encoding );
        $value = preg_replace( "/\s+/", "", $value );
        return $value;
    }
}

if (!function_exists('camelToSnake')) {
    function camelToSnake($camelCase)
    {
        $result = '';
        for ($i = 0; $i < strlen($camelCase); $i++) {
            $char = $camelCase[$i];
            if (ctype_upper($char)) {
                $result .= '_' . strtolower($char);
            } else {
                $result .= $char;
            }
        }

        return ltrim($result, '_');
    }
}

if (!function_exists('districtByDivision')) {
    function districtByDivision($divisionID)
    {
        if (!is_null($divisionID)) {
            $dists = \App\Models\District::where('dist_division_idfk', $divisionID)->get();
        } else {
            $dists = \App\Models\District::all();
        }
        return $dists;//->pluck('dist_id','dist_name')->toArray();
    }
}

if (!function_exists('tehsilDropDown')) {
    function tehsilDropDown($districtId, $selected = FALSE, $user_tehsil_id = '')
    {
        $str = '';
        $str .= '<option value="" selected>Please Select</option>';
        if (!is_null($districtId)) {
            $query = \App\Models\Tehsil::where('district_idfk', $districtId);
            if ($user_tehsil_id != '') {
                $tehsil_arr = explode(',', $user_tehsil_id);
                $query->whereIn('id', $tehsil_arr);
            }
            $dist = $query->get();
        } else {
            $dist = \App\Models\Tehsil::all();
        }

        if (!empty($dist)) {

            foreach ($dist as $sbname) {

                $sel = ($sbname['id'] == $selected) ? ' selected ' : '';

                $str .= '<option value="' . $sbname['id'] . '" ' . $sel . '>' . ucfirst($sbname['name']) . '</option>';
            }
        }

        return $str;

    }
}
