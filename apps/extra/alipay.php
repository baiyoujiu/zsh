<?php
return [	
		//应用ID,您的APPID。
		'app_id' => "2019062665689145",//租书会

		//商户私钥，您的原始格式RSA私钥
		'merchant_private_key' => "MIIEowIBAAKCAQEAvX0TKYw0ZHxbStUi/aL+LEIstDk4kStFAO7dAGvl1NfrrgQXYN4JW544oUqQs6n69wv8R3fRVaMnaF4f/oEYGVzEAxfMqEI4wYark3n3ET9IQEqH4JsOj7NP7irxoVWWBEceyHgHQbW2Nizt7kwm4FgbZ7yaAxFc62zQLYCq9q4SGxY9yPFX2y+dU2HsC14Oi7DbpRcM6MaNEFCGLdZd/gAu2cmZLA7Zy2nKVMbgXTu0ecV6fpxKQweJunbYDbyn5jDSwJan5UMqD4PRFXzvrkiLPoTdzTBUAz6C0+7U3A2RaIZKdJUHBuAATyEfev5GgHGEPe80acjTqPkDtPSaYwIDAQABAoIBAGRwUaHqMTM6P2GxC/UJWlS3Vt7IndVE7DSMaBR7HL3vHXuFq6aqyqcHfNjxnzW8WcxtS/HN7uXHr3HAwpCyeMWoyDUjflWJlG/wJC3trio0MuXxG4jQZ61/zFRf6ugrZ3MpB4YXKTGJUeXxdsSjFNBBo3UfITuTDn+zk70qwHQz8q9O6vgFUpeCy5OvoO4A4QgSc2fjELBVJyMvu6Sn9YeqZTPPmvaNMrHY3O998XnVHMHSD/7Uia7PJO3PJvoROCCaCWmMTXK6MkGuMyCn0K8rHmGE+Kzt2XO62PGlzIo+DnqiCyZeZchxiNVTCUF+6vdXQbuqrKKK+oN8a9/kssECgYEA5as6FN+HuWSnvzGtERfIrVWrMaVhbfSnU9xFoW9hf34U/wyO7BnVrgEQUXd0Gmye3IO9dgXO9NIHoJh1eRswmPTcrR9RzlmbivMqmFPopG/DHY06fvgLia9cruL4vKkyM2jboTYBcWNZ6KO7dbT6LObR1kDj/gld/mdNqjWc4LECgYEA0zaO3fFazUhI2dMJOyAkAB5t0CA8GCu34M/Ec0BlyjT8lkPXiVfKLY0oJmXUHVukakCl+cPN7yxH4fZziFrSyfdIMZJPoZ5YqHD9nQxQNH6uXJr+zXpvx3Ei+85sLmUoCJx0ip0skr5l2VyiJblHw01KEXRaKp7pwbWVe1XsEVMCgYEAwv/qxKY1urc3piIra4PiIynFvNVKL+211IIFrNfA1FrcwOCMyPH2d1L34/OkZHstNtW0G207FqrtRvGrbDQlwvjEFUmuT6HNauCjncpAkL1D0OeEbyFzymdWLjcQMj8GHJg/QlV0TC2qvNen5nzOnSktqNhXu+2AHOzhCE+U70ECgYAm/ve5uooNRL9OmEwoAnMjInsb5heyTsAQXcvji4w/nTDVfYkZ7n+BkYJMNJjJItZkV7NNPf2TnxVWfu4tyrcIWwOVQ3I4YMf1sYbhrBhS2ODQcD2DKovgwt62pxIKLtsJW/mYbhSAs26ShyvY0zCQuoBmYJkVLWnzPddvghmnyQKBgGS0WO97gGKwy9ltckQ+9e84TFn0M3U6s7XoOALgn6sPmb/dqWWb+w34iTYfJurEBn35j3fQtS2uj4CysLGNziP1DBrYXevh0qShJgoS66qiFvXRN0ZDFCmqL4qNuH+NyqfZhw2yHmA/iNnHwboctT5dXOo/ifSqlH96WU/spuka",
		
		//异步通知地址
		'notify_url' => "http://www.jingsuangou.com/payfund/alinurl.html",
		
		//同步跳转
		'return_url' => "http://www.jingsuangou.com/pay/alirurl.html",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsfqCCEffV5ruROaRRvclQ3yFK4cbTfRdM12nqbvyI2QWQump9nYS69BhJCahwRVx7bAoFARU3rkeNEYRfMj1Ae23Cot2xaGzG4BX34bLK2I/059SgbDFuT/45dEDi52WoJl8TWDgdcn8JxKiVNu6wOBHJoQ9JYUxfWYPLxcpFvKWMummeJ9ef5YzkMqBBdH1LPULMitPI0iobeh7CKraC6xQgA0EnQeAm81SpSFZBEPABswY++EGvstNpdfFailUNTDy4EhsAnZJUE8bg+CodkhF7U0FEqrw5EqayvVoO9lKvACBsgEN2zt8nB3Hl45BbZoxN0iJ+/ameiekUmAp8QIDAQAB",	
];