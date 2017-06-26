<!DOCTYPE>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>Korean Luxury</title>

    <meta name="robots" content="noindex, nofollow" />

    <link rel="shortcut icon" href="{{ asset('images/icon.png') }}" type="image/x-icon"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('crown/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/css.css') }}" media="screen" />
</head>

<body class="nobg loginPage" style="min-height:100%;">                    
    <div class="loginWrapper" style="top:45%;">
        <div class="widget" id="admin_login" style="height:auto; margin:auto;">
            <div class="title"><img src="{{ asset('images/icons/dark/laptop.png') }}" alt="" class="titleIcon" />
                <h6>Đăng nhập</h6>
            </div>
            <form class="form" id="form" action="{{ route('admin.post.login') }}" method="post">
                <input type="hidden" name="_url" value="{{ Request::get('url') }}">
               <fieldset>
                    <div class="formRow">
                        <label for="param_username">E-mail:</label>
                        <div class="loginInput"><input type="text" name="email" id="param_username" value="{{ old('email') }}" /></div>
                        <div class="loginInput">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="clear"></div>
                        
                    </div>
                    {!! method_field('POST') !!}
                    {!! csrf_field() !!}
                    <div class="formRow">
                        <label for="param_password">Mật khẩu:</label>
                        <div class="loginInput"><input type="password" name="password" id="param_password" /></div>
                        <div class="loginInput">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="loginControl">
                        <input type='hidden' name="submit" value='1'/>
                        <input type="submit"  value="Đăng nhập" class="dredB logMeIn" />
                        <div class="clear"></div>
                    </div>
                </fieldset>
            </form>
        </div>
    </div>  

    <!-- Footer line -->
    <div id="footer">
        <div class="wrapper">Bản quyền © 2012-2016 hocphp.info</div>
    </div>

    <script type="text/javascript">
        var admin_url   = '';
        var base_url    = '';
        var public_url  = '';
    </script>

    <script type="text/javascript" src="{{ asset('js/jquery/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/jquery-ui.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('crown/js/plugins/spinner/jquery.mousewheel.js') }}"></script>

    <script type="text/javascript" src="{{ asset('crown/js/plugins/forms/uniform.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/forms/jquery.tagsinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/forms/autogrowtextarea.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/forms/jquery.maskedinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/forms/jquery.inputlimiter.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('crown/js/plugins/tables/datatable.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/tables/tablesort.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/tables/resizable.min.js') }}"></script>

    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.tipsy.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.collapsible.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.progress.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.timeentry.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.colorpicker.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.jgrowl.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.breadcrumbs.js') }}"></script>
    <script type="text/javascript" src="{{ asset('crown/js/plugins/ui/jquery.sourcerer.js') }}"></script>

    <script type="text/javascript" src="{{ asset('crown/js/custom.js') }}"></script>


    <script type="text/javascript" src="{{ asset('js/ckeditor/ckeditor.js') }}"></script> 
    <script type="text/javascript" src="{{ asset('js/jquery/chosen/chosen.jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/scrollTo/jquery.scrollTo.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/number/jquery.number.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/formatCurrency/jquery.formatCurrency-1.4.0.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery/zclip/jquery.zclip.js') }}"></script>

    <script type="text/javascript" src="{{ asset('js/jquery/colorbox/jquery.colorbox.js') }}"></script>

    <link rel="stylesheet" type="text/css" href="{{ asset('js/jquery/colorbox/colorbox.css') }}" media="screen" />

    <script type="text/javascript" src="{{ asset('js/custom_admin.js') }}" type="text/javascript"></script>
    @yield('js')
</body>
</html>