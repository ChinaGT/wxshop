<?php

return [
		//应用ID,您的APPID。
		'app_id' => "2016092500595550",

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEpAIBAAKCAQEAvbCUR7i77CeKQIOSWOGgZSIXq6X88JlQRu7+eCS4BepKE+eDt+Q9YcseQ46N247xHrQlW/QHCqhwZtpFRnLB0r0eJfx1zDUItWIZ306u4sq5Ol7F7lu06pqcsRLojVlgwhA6N6CiGmivx7P2rQsYxBDqyEVHH1Q9dH78YpEzBJwzfuUsYPgnwIYkeKUpZtUErVhqzXr0SgHcbtfLvRwjGP+ispxtegU/zBWJ3VcHxbZHZydjIPPZY6gVhaeLQIHPKhfO9+KpCvIFaTu7FO7zkLxCLiavG8dMhgCAUEy3b8ey+M8c4dYY3SsYMcPY7sB+e28M5OMXPtFjCFNf7sY02wIDAQABAoIBAQCyZtF+huLPHvzq4hOQ3lsg4qiKeiljC34xyHKyAi7E+W3EPJhoKhQE1qjW9sq6NTzXGKyOR/sbbgGQ6jX/JMzf65fgOAl+Dl7rYKFeoTzf9bOxjxLus3d6sgEulM78qZPT0LlAOiZbWhwAYWRdqTMYq6R0yJs0fuDxoMCz30WxTauyG/dclnEuE5IgrCLkDWOY6jAXc9v3e09GsT+0/8u3RVbBSCEA+3sMDZm3czEQQoMyzZ+NlREu+p051HJMBuW826aIhQ1aONwR8aqMlTux2I2vBQadIolzy0CcZpwUTJGrGahZd3xRVJSIaJLq5ySeSFR3q3jm5vpp1Mvg4kkpAoGBAOv5hVQ19SuqPTVNeGdSmB7NPSlpfOJvXf1+NrlNT4iCjCRMVLbVgdsFkDIEzqPb06TIprhL/kEBb8yrQjuQwlzQ3eLOpEwY46hRRFOQ/Lw/WfegEGUGCKNpG6oRYFDRH2gj0ZMZr9edPic+KK5I9vOjjFAybknKOgtY/B3LwaBtAoGBAM3JiEI5w+JDdkAnX5jQkxK2tf8qvA3+gu6Apxe8QIM3bjs5jq44G9vcvATP1gbW3m4dh4XkIQPtGKOtPNx8vE/W4U0FSi8ct+s0l6e3g9olPspUl+zd0s1Jg7nK6lJ7BNqfULcpKw+q9CGYfU+bNVxz6R8wizyQdN0/xuBtKa1nAoGAZfSdYtEdaQxY/drHFv1ctJJAxs/JIZy0o34Q7uc0Yerl2hkQ0R5WyOcSckoZbjrgquX3AtHyvOt9/pRQPaRCFhA4jnJyEl7+ng7e0qxmRn+ow5DpBH0i5lfXmBeB4ek5BKnVNxV2IFbUL+hvcz4bVRFo4o2nkUJK6fQ8mjMbKdECgYEAiLAjdLG/3eungQdmJS/tcNGx45J0JOt39om38zkUtNO9wVMC5c/ZGVnt/Vg7toFEb2nn2dRk5aG36wgn0+B6iKGXNzybQN3XgECHt1xbFSwGIAi+fRP+cGMzPtZ8fFrAJ6MIzxBmTNrlm+cY3Saf9A/9ubzZz1m4djlllS6NL2MCgYB2aPURsrV2CyMt5PXcdrZMAJsbZh6ksdBI397mIl7yqbJXz5gT/EhcbkpxRa+uQt/gnmLJpHWwf+nOADBby4CUbKKPpHlTp+rOiwSg3DkgDcgm2rxIVwFQ3fht5ev2L+YgX8LHZfMnmU8JD6nZKGLW5tcKlPJIzGjG77dBF+suRg==",
		
		//异步通知地址
		'notify_url' => "http://gt.zty77.com/notify",
		
		//同步跳转
		'return_url' => "http://www.wxshop.com/alipaydo",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAvbCUR7i77CeKQIOSWOGgZSIXq6X88JlQRu7+eCS4BepKE+eDt+Q9YcseQ46N247xHrQlW/QHCqhwZtpFRnLB0r0eJfx1zDUItWIZ306u4sq5Ol7F7lu06pqcsRLojVlgwhA6N6CiGmivx7P2rQsYxBDqyEVHH1Q9dH78YpEzBJwzfuUsYPgnwIYkeKUpZtUErVhqzXr0SgHcbtfLvRwjGP+ispxtegU/zBWJ3VcHxbZHZydjIPPZY6gVhaeLQIHPKhfO9+KpCvIFaTu7FO7zkLxCLiavG8dMhgCAUEy3b8ey+M8c4dYY3SsYMcPY7sB+e28M5OMXPtFjCFNf7sY02wIDAQAB",
		
	
];