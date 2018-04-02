<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'weixin' => [
        'client_id' => env('WEIXIN_KEY'),
        'client_secret' => env('WEIXIN_SECRET'),
        'redirect' => env('WEIXIN_REDIRECT_URI'),  
    ],

    'weixinweb' => [
        'client_id' => env('WEIXINWEB_KEY'),
        'client_secret' => env('WEIXINWEB_SECRET'),
        'redirect' => env('WEIXINWEB_REDIRECT_URI'),  
    ],

    'weibo' => [
        'client_id' => env('WEIBO_KEY'),
        'client_secret' => env('WEIBO_SECRET'),
        'redirect' => env('WEIBO_REDIRECT_URI'),  
    ],

    'qq' => [
        'client_id' => env('QQ_KEY'),
        'client_secret' => env('QQ_SECRET'),
        'redirect' => env('QQ_REDIRECT_URI'),  
    ], 
    'alipay_config'=> [
        //应用ID,您的APPID。
        'app_id' => "2017032906453263",
        //商户私钥，您的原始格式RSA私钥
        'merchant_private_key' => 'MIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDOm859Ewk6pN9/MFHN8UZliJzfnI2Vlq4r0B/9jN77mJIxV+CBihcxPAg/3fypImSRaOZjFC0ibST5eEuFUXrxo5+dS8E/Y3BJ1Jof1eu3akJDq4bc4s60I4W3x/pZxPavYU9SSzJO2m1OJZZouMJt8iweAXQxc58QIhBlotj8vBtjlPROSmblHqj2+/srMM81BsZIe+wq89eVNq0Y3V4meg7VeYbGzJ3Et4whQ6oaRfK2Y6xc7QbbyQC4XnTQpcewaMmhhfi+yn+S8+lk3uH6ZmdPBQxkaxwOpwNF+LtMxunDu4gF4kUy1aOFbmESJ31RpZmp2UXeIDiF+Cvi3N3BAgMBAAECggEASu4GvSWiOzqAM8h6Yo4WUcxx2EcWsiGrmQgqEfJ9DBIRMwQDz/cc4iY7d64ya8SlZHb+1wACPnIG7tLJ0Nf0Fp6YzJskwrB1kNEh9FnI2wQWdCRJDOLUxE/9tuE30ka0kHZiJh5PaHmfGrBXFDOtj+I8TcWJNkYQcfFosPOWblHClxTT7dQF+zOnh4CjkTjXGI6idg2hr39VVGJ7Sam5tD+LEZZiCAMu9wTYDpk0JyNmfNDNWyZQTKtpKTWtanaQcqBhvR9TjZiLEI3TMYGx2+UqeuZ85tXkwueDOwkEUPz13GW0uTCFBdJ+VI+3UXYQB7sv7ApT0Cz1hraeB6kC4QKBgQD+JFuT2odCjSHnyaEgz6uEBtDBVU5lKywXjfZouIKgqnbf6g/bTxgBIhJbj0UhR31equY7HKZk+OtHWYoRnH0zqYn7rxk9gsfYc7LdoqG1fZDXnvPVNAnA1DGaxVsrs+mNoQxVQ09F6Iqi8Sh9Zn2RKU5Bc+wsdaBXjKiBQ1i5iwKBgQDQHny580nzfuq3aAhFyWvfBtuDIg0hstKkKBUZ8ByqCF0l8jRLPLYsgmDInd8j60JxZ1nVE0HxNpRrgzROLXsYG150tKHNctqqIEdLs4m9Rd7ifiqjAwbX0PHwReP3O8qWiqYNdkK1osp7zqDs4K8pni6XdwssQGyEIhwAdpj3YwKBgA7HSHgBlin9kQIsjG0fBmdICi2j60ogx5CbFcAjMp1rLDx7HO7w24F9XLnsS+XShWzS3U6ErPxkKTJd95RsmC8/5aE4HmygRUTF/Zm70lF+esS/HojAXOzUqgnI/jM9ZBBzVAdFQb/b9OviwCsCobymPUG7Hvm64VcV+9qAcxFfAoGASmnsPOzBj1/c+vEmrBVGDbu891lQirEO4gU27kxNY3qUG8JLcm9lz+paQsE4DPbMjhHfK/GzzVSvovWJ2T4n2knG70G67OPZTaU2+NlcMaHu/NsR0bF+W+Jo73l99mOZn1Q55WxYk+t+LOCH58q6ts3JaPz2sL7kTiaIDp5ZOXMCgYEA06mHEtyNwfqpQDpYyFjRUhFqzeARvWqB0jQl9N3CzmK9DN6HrCTBAm+nL0aeoe/b0VLcwK7XHjvdEvPaHWyxPEjGympkIqZ+v6QE1vrdaUd1quO4/QovyogHWXeXy91TkPyrh7VmMwXzpwi3R0FH2M6DefRK843+bLNCHBUR/Hk=',
        //编码格式
        'charset' => "UTF-8",
        //签名方式
        'sign_type'=>"RSA",
        //支付宝网关
        'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
        //支付宝公钥
        'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsS1RWbmYLr3Yx7b/HIzE8lIvNr8gK7dBWGgPBDokTCV7fcU2id4ESjBXB4pggIPO+qvMFyu2iKlsB4Eya4kg/qp0WFKor48MhrT8J6N6JWSz799Dxt4jlVfa16NuJj3x9il5Ih85FDNi5zJul83F9Dh6lq+Tx+7PCydYcHHj+bct1p0O/A62CFR0bhiQNUJ3imCPzkmhoKzC6KACCegZuKh1j2Hnn7dcPPvADYDA7vHU/wZhweKnl26D6knoRRqukfIR0pR51Les5m8rI2XVcrqc9aOTa5+/WHcwBGvNAenRB1rzmT94pyF/JhcceI85odg6EYhsgAIigogkZ/JEswIDAQAB",
    ],
    
    'alipay_sand_box_config'=> [
        //应用ID,您的APPID。
        'app_id' => "2016080400161746",
        //商户私钥，您的原始格式RSA私钥
        'merchant_private_key' => 'MIICXgIBAAKBgQC1v4KqIO89RGYIBcUoolNvGhNMeRc4YLgqtgCwgFrqaxZCidNux3S5meQeFXFp7U83ZTLAt2pra8kotgeuRFXmOIxvZP8ys3l0SpXBGlCnm2UsckN9olNJhJ7WQKMKMZPAjBlktSrpNGheuhQ/D7iioOXNlc8dw1xEoslSpsjzVQIDAQABAoGAIibxi7ySmCWxMpK7AK64FOmGdNlQRrTOBqCaso/8BY7H6QrzIx7xzSqg1hJbdHc2aodmqRYONk9TxoWmHdYTedTcrTtM7smrdQpRCUCNtpDh1AHu7VchJO9BH3vhGscHnJnngLMiyg6TdkZfissWdv35W8Ob3hAZf2UaIuUoFaECQQDwfD/6VsfuFw412lBzcn1VpsNxfe5Oj16/4i2XHKJ6qtGEL2jH4K2yBi7l4BKwL0Tz9HlLCuUqfXQmpNZ68V6NAkEAwXkuhfLbGFJwmq+u5grQhQ4HeOeqrr4oVVBcTyDICq0Sq8fr3ZXKpUEjNthUevM8XVbnOEs+ZciPsrhJDF656QJBAKFS+Kg7Jwu1M7c0qNuJZkLbCClOTVsuGmWmmObSMr0PclW2aBgNxPez5ioXUvIWA6+TxPpuaKVEW3LBCZCX8tECQQCRzKzOrNGHZrkNGVAIdCXn30aqSotJ3GuwvzqRNvcJdJwZcDPDbNql5oyPDD+92Aepn4/n0GxZb+c6m74Q4GHhAkEAmXqV29fpxNs1k3/1oKyKBbw5a0SlXQ9p8OqwLDxmQ10A3Wo2y1UK5peRxznlL0ikO9rHsSjSXsh67/oHYKp4lQ==',
        //编码格式
        'charset' => "UTF-8",
        //签名方式
        'sign_type'=>"RSA",
        //支付宝网关
        'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",
        //支付宝公钥
        'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDIgHnOn7LLILlKETd6BFRJ0GqgS2Y3mn1wMQmyh9zEyWlz5p1zrahRahbXAfCfSqshSNfqOmAQzSHRVjCqjsAw1jyqrXaPdKBmr90DIpIxmIyKXv4GGAkPyJ/6FTFY99uhpiq0qadD/uSzQsefWo0aTvP/65zi3eof7TcZ32oWpwIDAQAB",
    ]
];
