<?php

class PoemTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::table('poems')->delete();
		Poem::create( [ 'content' => '关关雎鸠 在河之洲 窈窕淑女 君子好逑', 'poet' => '诗经' ] );
		Poem::create( [ 'content' => '死生契阔 与子成说 执子之手 与子偕老', 'poet' => '诗经' ] );
		Poem::create( [ 'content' => '我住长江头 君住长江尾 日日思君不见君 共饮长江水', 'poet' => '李之仪' ] );
		Poem::create( [ 'content' => '山无陵 江水为竭 冬雷震震 夏雨雪 天地合 乃敢与君绝', 'poet' => '上邪' ] );
		Poem::create( [ 'content' => '问世间情是何物 直教生死相许', 'poet' => '元好问' ] );
		Poem::create( [ 'content' => '东边日出西边雨 道是无晴却有晴', 'poet' => '刘禹锡' ] );
		Poem::create( [ 'content' => '曾经沧海难为水 除却巫山不是云', 'poet' => '元稹' ] );
		Poem::create( [ 'content' => '举杯邀明月 对影成三人', 'poet' => '李白' ] );
		Poem::create( [ 'content' => '谁言寸草心 报得三春晖', 'poet' => '孟郊' ] );
		Poem::create( [ 'content' => '抽刀断水水更流 举杯消愁愁更愁', 'poet' => '李白' ] );
		Poem::create( [ 'content' => '忽如一夜春风来 千树万树梨花开', 'poet' => '岑参' ] );
		Poem::create( [ 'content' => '回眸一笑百媚生 六宫粉黛无颜色', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '七月七日长生殿 夜半无人私语时', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '在天愿作比翼鸟 在地愿为连理枝', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '天长地久有时尽 此恨绵绵无绝期', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '千呼万唤始出来 犹抱琵琶半遮面', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '别有幽愁暗恨生 此时无声胜有声', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '同是天涯沦落人 相逢何必曾相识', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '长风破浪会有时 直挂云帆济沧海', 'poet' => '李白' ] );
		Poem::create( [ 'content' => '人生得意须尽欢 莫使金樽空对月', 'poet' => '李白' ] );
		Poem::create( [ 'content' => '天生我材必有用 千金散尽还复来', 'poet' => '李白' ] );
		Poem::create( [ 'content' => '海上生明月 天涯共此时', 'poet' => '张九龄' ] );
		Poem::create( [ 'content' => '海内存知己 天涯若比邻', 'poet' => '王勃' ] );
		Poem::create( [ 'content' => '星垂平野阔 月涌大江流', 'poet' => '杜甫' ] );
		Poem::create( [ 'content' => '明月松间照 清泉石上流', 'poet' => '王维' ] );
		Poem::create( [ 'content' => '野火烧不尽 春风吹又生', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '出师未捷身先死 长使英雄泪满襟', 'poet' => '杜甫' ] );
		Poem::create( [ 'content' => '诚知此恨人人有 贫贱夫妻百事哀', 'poet' => '元稹' ] );
		Poem::create( [ 'content' => '此情可待成追忆 只是当时已惘然', 'poet' => '李商隐' ] );
		Poem::create( [ 'content' => '身无彩凤双飞翼 心有灵犀一点通', 'poet' => '李商隐' ] );
		Poem::create( [ 'content' => '相见时难别亦难 东风无力百花残', 'poet' => '李商隐' ] );
		Poem::create( [ 'content' => '春蚕到死丝方尽 腊炬成灰泪始干', 'poet' => '李商隐' ] );
		Poem::create( [ 'content' => '红豆生南国 春来发几枝', 'poet' => '王维' ] );
		Poem::create( [ 'content' => '春眠不觉晓 处处闻啼鸟 夜来风雨声 花落知多少', 'poet' => '孟浩然' ] );
		Poem::create( [ 'content' => '床前明月光 疑是地上霜 举头望明月 低头思故乡', 'poet' => '李白' ] );
		Poem::create( [ 'content' => '白日依山尽 黄河入海流 欲穷千里目 更上一层楼', 'poet' => '王之涣' ] );
		Poem::create( [ 'content' => '千山鸟飞绝 万径人踪灭', 'poet' => '柳宗元' ] );
		Poem::create( [ 'content' => '夕阳无限好 只是近黄昏', 'poet' => '李商隐' ] );
		Poem::create( [ 'content' => '独在异乡为异客 每逢佳节倍思亲', 'poet' => '王维' ] );
		Poem::create( [ 'content' => '孤帆远影碧空尽 惟见长江天际流', 'poet' => '李白' ] );
		Poem::create( [ 'content' => '月落乌啼霜满天 江枫渔火对愁眠', 'poet' => '张继' ] );
		Poem::create( [ 'content' => '东风不与周郎便 铜雀春深锁二乔', 'poet' => '杜牧' ] );
		Poem::create( [ 'content' => '天阶夜色凉如水 坐看牵牛织女星', 'poet' => '杜牧' ] );
		Poem::create( [ 'content' => '何当共剪西窗烛 却话巴山夜雨时', 'poet' => '李商隐' ] );
		Poem::create( [ 'content' => '嫦娥应悔偷灵药 碧海青天夜夜心', 'poet' => '李商隐' ] );
		Poem::create( [ 'content' => '劝君更尽一杯酒 西出阳关无故人', 'poet' => '王维' ] );
		Poem::create( [ 'content' => '花开堪折直须折 莫待无花空折枝', 'poet' => '杜秋娘' ] );
		Poem::create( [ 'content' => '少壮不努力 老大徒伤悲', 'poet' => '长歌行' ] );
		Poem::create( [ 'content' => '孔雀东南飞 五里一徘徊', 'poet' => '孔雀东南飞' ] );
		Poem::create( [ 'content' => '对酒当歌 人生几何', 'poet' => '曹操' ] );
		Poem::create( [ 'content' => '盈盈一水间 脉脉不得语', 'poet' => '古诗十九首' ] );
		Poem::create( [ 'content' => '本自同根生 相煎何太急', 'poet' => '曹植' ] );
		Poem::create( [ 'content' => '不识庐山真面目 只缘身在此山中', 'poet' => '苏轼' ] );
		Poem::create( [ 'content' => '明月几时有 把酒问青天 不知天上宫阙 今夕是何年', 'poet' => '苏轼' ] );
		Poem::create( [ 'content' => '人有悲欢离合 月有阴晴圆缺 此事古难全 但愿人长久 千里共婵娟', 'poet' => '苏轼' ] );
		Poem::create( [ 'content' => '人生如梦 一尊还酹江月', 'poet' => '苏轼' ] );
		Poem::create( [ 'content' => '春色三分 二分尘土 一分流水 细看来 不是杨花 点点是 离人泪', 'poet' => '苏轼' ] );
		Poem::create( [ 'content' => '花自飘零水自流 一种相思 两处闲愁 此情无计可消除 才下眉头 却上心头', 'poet' => '李清照' ] );
		Poem::create( [ 'content' => '梧桐更兼细雨 到黄昏 点点滴滴 这次第 怎一个 愁字了得', 'poet' => '李清照' ] );
		Poem::create( [ 'content' => '月上柳梢头 人约黄昏后', 'poet' => '朱淑真' ] );
		Poem::create( [ 'content' => '众里寻他千百度 蓦然回首 那人却在 灯火阑珊处', 'poet' => '辛弃疾' ] );
		Poem::create( [ 'content' => '而今识尽愁滋味 欲说还休 欲说还休 却道天凉好个秋', 'poet' => '辛弃疾' ] );
		Poem::create( [ 'content' => '七八个星天外 两三点雨山前 旧时茅店社林边 路转溪桥忽见', 'poet' => '辛弃疾' ] );
		Poem::create( [ 'content' => '韶华不为少年留 恨悠悠 几时休', 'poet' => '秦观' ] );
		Poem::create( [ 'content' => '金风玉露一相逢 便胜却 人间无数', 'poet' => '秦观' ] );
		Poem::create( [ 'content' => '柔情似水 佳期如梦 忍顾鹊桥归路 两情若是久长时 又岂在 朝朝暮暮', 'poet' => '秦观' ] );
		Poem::create( [ 'content' => '无情 任是无情也动人', 'poet' => '秦观' ] );
		Poem::create( [ 'content' => '今年花胜去年红 可惜明年花更好 知与谁同', 'poet' => '欧阳修' ] );
		Poem::create( [ 'content' => '泪眼问花花不语 乱红飞过秋千去', 'poet' => '欧阳修' ] );
		Poem::create( [ 'content' => '今宵剩把银釭照 犹恐相逢是梦中', 'poet' => '晏几道' ] );
		Poem::create( [ 'content' => '问君能有几多愁 恰似一江春水向东流', 'poet' => '李煜' ] );
		Poem::create( [ 'content' => '胭脂泪 相留醉 几时重 自是人生长恨水长东', 'poet' => '李煜' ] );
		Poem::create( [ 'content' => '无言独上西楼 月如钩 寂寞梧桐深院锁清秋', 'poet' => '李煜' ] );
		Poem::create( [ 'content' => '剪不断 理还乱 是离愁 别是一般滋味在心头', 'poet' => '李煜' ] );
		Poem::create( [ 'content' => '别时容易见时难 流水落花春去也 天上人间', 'poet' => '李煜' ] );
		Poem::create( [ 'content' => '无可奈何花落去 似曾相识燕归来', 'poet' => '晏殊' ] );
		Poem::create( [ 'content' => '落花风雨更伤春 不如怜取眼前人', 'poet' => '晏殊' ] );
		Poem::create( [ 'content' => '昨夜西风凋碧树 独上高楼 望尽天涯路', 'poet' => '晏殊' ] );
		Poem::create( [ 'content' => '多情自古伤离别 更那堪 冷落清秋节', 'poet' => '柳永' ] );
		Poem::create( [ 'content' => '今宵酒醒何处 杨柳岸 晚风残月', 'poet' => '柳永' ] );
		Poem::create( [ 'content' => '此去经年 应是良辰好景虚设 便纵有千种风情 更与何人说', 'poet' => '柳永' ] );
		Poem::create( [ 'content' => '衣带渐宽终不悔 为伊消得人憔悴', 'poet' => '柳永' ] );
		Poem::create( [ 'content' => '当年不肯嫁春风 无端却被秋风误', 'poet' => '贺铸' ] );
		Poem::create( [ 'content' => '日出江花红胜火 春来江水绿如蓝 能不忆江南', 'poet' => '白居易' ] );
		Poem::create( [ 'content' => '明月楼高休独倚 酒入愁肠 化作相思泪', 'poet' => '范仲淹' ] );
		Poem::create( [ 'content' => '人生若只如初见 何事秋风悲画扇', 'poet' => '安意如' ] );
		Poem::create( [ 'content' => '来我怀里 或者 让我住进你的心里 默然相爱 寂静喜欢', 'poet' => '仓央嘉措' ] );
		Poem::create( [ 'content' => '最佳的报复不是仇恨 而是打心底发出的冷淡 干嘛花力气去恨一个不相干的人', 'poet' => '舒婷' ] );
		Poem::create( [ 'content' => '生命从来不是公平的 得到多少 便要靠那个多少做到最好 努力的生活下去', 'poet' => '舒婷' ] );
		Poem::create( [ 'content' => '一个人走不开 不过因为他不想走开 一个人失约 乃因他不想赴约 一切借口均属废话 都是用以掩饰不愿牺牲', 'poet' => '舒婷' ] );
		Poem::create( [ 'content' => '当我痛苦地站在你的面前 你不能说我一无所有 你不能说我两手空空', 'poet' => '海子' ] );
		Poem::create( [ 'content' => '今天 我什么也不说 让别人去说', 'poet' => '海子' ] );
		Poem::create( [ 'content' => '黑夜一无所有 为何给我安慰', 'poet' => '海子' ] );
		Poem::create( [ 'content' => '你一会看我 一会看云 我觉得你看我时很远 你看云时很近', 'poet' => '顾城' ] );
		Poem::create( [ 'content' => 'My heart, the bird of the wilderness, has found its sky in your eyes.', 'poet' => 'Tagore' ] );
		Poem::create( [ 'content' => 'Let life be beautiful like summer flowers and death like autumn leaves.', 'poet' => 'Tagore' ] );
		Poem::create( [ 'content' => 'The furthest distance in the world，is not between life and death. But when I stand in front of you，Yet you don\'t know that I love you.', 'poet' => 'Tagore' ] );
		Poem::create( [ 'content' => 'I love you not because of who you are, but because of who I am when I am with you.', 'poet' => '' ] );
		Poem::create( [ 'content' => 'To the world you may be one person, but to one person you may be the world.', 'poet' => '' ] );
		Poem::create( [ 'content' => 'Don\'t cry because it is over, smile because it happened.', 'poet' => '' ] );
		Poem::create( [ 'content' => '其实 每个人都是幸福的 只是你的幸福常常在别人眼里', 'poet' => '' ] );
		Poem::create( [ 'content' => '黛玉笑道:"偏是咬舌子爱说话,连个‘二’哥哥也叫不出来, 只是‘爱‘哥哥’爱‘哥哥的.回来赶围棋儿,又该你闹’幺爱三四五‘了.', 'poet' => '红楼梦' ] );
		Poem::create( [ 'content' => '每日家情思睡昏昏', 'poet' => '林黛玉' ] );
		Poem::create( [ 'content' => '黛玉道：“别理他，你先给 我舀水去罢。”紫鹃笑道：“他是客，自然先倒了茶来再舀水去。”说着倒茶去了。宝玉笑道：“好丫头，‘若共你多情小姐同鸳帐，怎舍得叠被铺床？’”', 'poet' => '红楼梦' ] );

	}

}
