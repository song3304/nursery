<?php

return [
	'member' => [
		'store' => [
			'username' => [
				'name' => '用户名',
				'rules' => 'required|ansi:2|unique:users,{{attribute}},{{id}}|regex:/^[a-z0-9\x{4e00}-\x{9fa5}\x{f900}-\x{fa2d}]*$/iu|max:150|min:3',
				'message' => [
					'regex' => '[:attribute] 必须为汉字、英文、数字',
				],
			],
			'nickname' => [
				'name' => '昵称',
				'rules' => 'string|min:1',
			],
			'realname' => [
				'name' => '真实姓名',
				'rules' => 'ansi:2|regex:/^[a-z\x{4e00}-\x{9fa5}\x{f900}-\x{fa2d}\s]*$/iu|max:50|min:3',
				'message' => [
					'regex' => '[:attribute] 必须为汉字、英文'
				],
			],
			'password' => [
				'name' => '密码',
				'rules' => 'required|min:6|confirmed',
			],
			'password_confirmation ' => [
				'name' => '确认密码',
				'rules' => 'required',
			],
			'gender' => [
				'name' => '性别',
				'rules' => 'required|not_zero|catalog:fields.gender',
			],
			'phone' => [
				'name' => '手机',
				'rules' => 'phone|unique:users,{{attribute}},{{id}}',
			],
			'idcard' => [
				'name' => '身份证',
				'rules' => 'idcard|unique:users,{{attribute}},{{id}}',
			],
			'email' => [
				'name' => 'E-Mail',
				'rules' => 'email|unique:users,{{attribute}},{{id}}',
			],
			'avatar_aid' => [
				'name' => '用户头像',
				'rules' => 'numeric',
			],
			'role_ids' => [
				'name' => '用户组',
				'rules' => 'required|array',
				'tag_name' => 'role_ids[]',
			],
			'accept_license' => [
				'name' => '阅读并同意协议',
				'rules' => 'accepted',
			]
		],
		'login' => [
			'username' => [
				'name' => '用户名',
				'rules' => 'required',
			],
			'password' => [
				'name' => '密码',
				'rules' => 'required',
			],
		],
	    'modify_pwd'=>[
	        'old_pwd' => [
    	        'name' => '旧密码',
    	        'rules' => 'required|min:6',
    	    ],
	        'password' => [
    	        'name' => '新密码',
    	        'rules' => 'required|min:6|confirmed',
    	    ],
    	    'password_confirmation ' => [
    	        'name' => '确认密码',
                'rules' => 'required',
    	    ]
	   ]
	],
	'tag' => [
		'store' => [
			'keywords' => [
				'name' => '话题',
				'rules' => 'required|max:50',
			],
		],
	],
    'user-address'=>[
        'store' => [
            'user_id'=>[
                'name' => '会员',
                'rules' => 'required|numeric',
            ],
            'account_num'=>[
                'name' => '户号',
                'rules' => 'required|numeric',
            ],
            'account_name'=>[
                'name' => '户名',
                'rules' => 'required',
            ],
            'account_address'=>[
                'name' => '住址信息',
                'rules' => 'required',
            ],
            'account_phone'=>[
                'name' => '预留电话',
                'rules' => 'required|phone',
            ]
        ]
    ],
    'banner' => [
        'store' => [
            'title' => [
                'name' => '标题',
                'rules' => 'required'
            ],
            'url' => [
                'name' => '网址',
                'rules' => 'url'
            ],
            'status' => [
                'name' => '状态',
                'rules' => 'required|bool'
            ],
            'cover' => [
                'name' => '封面',
                'rules' => 'required'
            ],
            'location' => [
                'name' => '位置',
                'rules' => 'numeric',
            ],
           'porder' => [
                'name' => '排序',
                'rules' => 'numeric'
            ]
        ],
    ],
    'notice' => [
        'store' => [
            'title' => [
                'name' => '标题',
                'rules' => 'required'
            ],
            'contents' => [
                'name' => '内容',
                'rules' => 'required'
            ]
        ]
    ],
    'article' => [
        'store' => [
            'title' => [
                'name' => '标题',
                'rules' => 'required'
            ],
            'pic_id' => [
                'name' => '图片',
                'rules' => 'numeric'
            ],
            'contents' => [
                'name' => '内容',
                'rules' => 'required'
            ],
            'type' =>[
                'name' => '类型',
                'rules' => 'numeric|max:2'
            ]
        ]
    ],
    'question' => [
        'store' => [
            'user_id' => [
                'name' => '用户id',
                'rules' => 'numeric|required'
            ],
            'content' => [
                'name' => '内容',
                'rules' => 'required'
            ],
            'pid' => [
                'name' => '父级',
                'rules' => 'numeric'
            ],
        ]
    ],
    'order'=>[
        'store' => [
            'user_id'=>[
                'name' => '用户',
                'rules' => 'required|numeric',
            ],
            'address_id'=>[
                'name' => '地址',
                'rules' => 'required|numeric',
            ],
            'account_num'=>[
                'name' => '户号',
                'rules' => [],
            ],
            'account_name'=>[
                'name' => '户名',
                'rules' => [],
            ],
            'account_address'=>[
                'name' => '住址信息',
                'rules' => [],
            ],
            'account_phone'=>[
                'name' => '预留电话',
                'rules' => [],
            ],
            'sumMoney'=>[
                'name' => '交费总金额',
                'rules' => 'required|numeric',
            ],
            'order_log'=>[
                'name' => '订单日志',
                'rules' => [],
            ]
        ]
    ]
];