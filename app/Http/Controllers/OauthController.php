<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Plugins\Attachment\App\Attachment as AttachmentModel;
use App\SocialiteUser;
use App\User;
use Cache;

class OauthController extends Controller
{
    public function qq(Request $request){
        $url = $request->get('callback_url')?:url('ucenter');
        return \Socialite::with('qq')->redirectUrl(env('QQ_REDIRECT_URI').'?callback_url='.urlencode($url))->redirect();
    }
    
    public function qqCallback(Request $request){
        $oauthUser = \Socialite::with('qq')->user();
        $url = $request->get('callback_url')?:url('ucenter');
        //查找当前用户，如果存在直接登录
        $qq_user = SocialiteUser::where('login_type',0)->where('plat_id',$oauthUser->getId())->first();
        if(empty($qq_user)){
            if(!empty($oauthUser->getAvatar())){
                $attachment = (new AttachmentModel)->download(0, $oauthUser->getAvatar(), 'qq-avatar-'.$oauthUser->getId(), 'jpg');
                $avatar_aid = $attachment->getKey();
            }else{
                $avatar_aid = 0;
            }
            //添加一个普通用户
            $user = User::add([
                'username' => 'qq'.$oauthUser->getId(),
                'password' => '',
                'gender' => 11,
            ], 'user1');
            
            $qq_user = SocialiteUser::create(['plat_id'=>$oauthUser->getId(), 'username'=>$oauthUser->getName()?:'',
                'nick_name'=>$oauthUser->getNickname()?:'',  'email'=>$oauthUser->getEmail()?:'',
                'login_type'=>0, 'avatar_aid'=>$avatar_aid,
                'user_id'=>$user->getKey()]);
            
            
            $hashkey = 'update-user-from-qq-'.$user->getKey();
            if (is_null(Cache::get($hashkey, null)))
            {
                $user->update([
                    'nickname' => $qq_user->nick_name?:$qq_user->username,
                    'avatar_aid' => $avatar_aid,
                ]);
                Cache::put($hashkey, time(), config('cache.ttl'));
            }  
        }
        Auth::guard()->loginUsingId($qq_user->user_id);
        return redirect($url);
    }
    
    public function weixin(Request $request){
        $url = $request->get('callback_url')?:url('ucenter');
        return \Socialite::with('weixinweb')->redirectUrl(env('WEIXINWEB_REDIRECT_URI').'?callback_url='.urlencode($url))->redirect();
    }
    
    public function weixinCallback(Request $request){
        $oauthUser = \Socialite::with('weixinweb')->user();
        $url = $request->get('callback_url')?:url('ucenter');
        //查找当前用户，如果存在直接登录
        $weixin_user = SocialiteUser::where('login_type',1)->where('plat_id',$oauthUser->getId())->first();
        if(empty($weixin_user)){
            if(!empty($oauthUser->getAvatar())){
                $attachment = (new AttachmentModel)->download(0, $oauthUser->getAvatar(), 'weixin-avatar-'.$oauthUser->getId(), 'jpg');
                $avatar_aid = $attachment->getKey();
            }else{
                $avatar_aid = 0;
            }
            //添加一个普通用户
            $user = User::add([
                'username' => 'wx'.$oauthUser->getId(),
                'password' => '',
                'gender' => 11,
            ], 'user1');
            
            $weixin_user = SocialiteUser::create(['plat_id'=>$oauthUser->getId(), 'username'=>$oauthUser->getName()?:'',
                'nick_name'=>$oauthUser->getNickname()?:'',  'email'=>$oauthUser->getEmail()?:'',
                'login_type'=>2, 'avatar_aid'=>$avatar_aid,
                'user_id'=>$user->getKey()]);
            
            
            $hashkey = 'update-user-from-weixin-web-'.$user->getKey();
            if (is_null(Cache::get($hashkey, null)))
            {
                $user->update([
                    'nickname' => $weixin_user->nick_name?:$weixin_user->username,
                    'avatar_aid' => $avatar_aid,
                ]);
                Cache::put($hashkey, time(), config('cache.ttl'));
            }  
        }
        Auth::guard()->loginUsingId($weixin_user->user_id);
        return redirect($url);
    }
}
