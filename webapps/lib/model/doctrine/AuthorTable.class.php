<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class AuthorTable extends Doctrine_Table
{
	public static function getId()
	{
		$author = array();
		$a = Doctrine_Query::create()
		->from('Author a')->orderBy('a.name')->execute();
		foreach($a as $a){
			$author[$a['id']] = $a['id'];
		}
		return $author;
	}
	
	public static function getName()
	{
		$author = array();
		$a = Doctrine_Query::create()
		->from('Author a')->orderBy('a.name')->execute();
		foreach($a as $a){
			$author[$a['id']] = $a['name'];
		}
		asort($author);
		return $author;
	}
	public static function getItem()
	{
		$item = array();
		$item = array( 45 => "海外CSG", 20 => "SSCM", 232 => 'CSG' ,22 => "TSG", 204 => "PSG", 209 => "SSCM北京", 7 => "SCMS札幌", 8 => "SCMS秋田", 9 => "SCMS十和田", 5 => "SCMS郡山" , 6 => 'SCMS郡山支店' , 10 => "SCMS沼田", 13 => "SCMS千葉", 12 => "SCMS水戸", 11 => "SCMS上越", 18 => "SCMS北陸", 260 => 'SCMS香川', 17 => "SCMS北九州", 16 => "SCMS飯塚", 19 => "SKT宇都宮", 3 => "CS企画G", 251 => 'OSK滋賀' , 4 => "OSK京奈", 185 => "北海道", 82 => "札幌", 216 => '札幌支店' , 39 => "旭川", 215 => '旭川支店' , 171 => "函館", 163 => "東北CS", 94 => "秋田", 221 => '秋田支店', 120 => "青森", 121 => "青森支店", 97 => "十和田", 117 => "盛岡", 118 => "盛岡支店", 63 => "宮古駐在", 122 => "仙台", 123 => "仙台支店", 127 => "前橋",
		80 => "埼玉", 81 => "埼玉支店", 125 => "千葉", 126 => "千葉支店", 112 => "水戸", 113 => "水戸(営)", 115 => "水戸CS", 41 => "宇都宮" , 104 => "沼田営業所", 187 => "北関東", 188 => "北関東支店", 244 => '神奈川' , 245 => '神奈川支店' , 255 => '秦野駐在' , 166 => "南関東", 218 => '南関東支店' , 93 => "首都圏", 202 => "首都圏(営)", 60 => "関東甲信越", 61 => "関東甲信越CS", 62 => "関東甲信越CSG", 128 => "多摩", 130 => "多摩(営)", 105 => "新潟", 222 => '新潟(営)' , 250 => '新潟(営)長岡駐在' , 74 => "甲信越", 75 => "甲信越CS", 194 => "木曽", 151 => "長野", 152 => "長野支店", 86 => "山梨駐在", 173 => "飯田", 237 => '飯田(営)' , 178 => "浜松", 203 => "浜松(営)", 193 => "名古屋", 225 => '名古屋支店', 262 => '中部統括部販促G', 144 => "中部", 145 => "中部CS", 146 => "中部CSG",
		174 => "飛騨", 175 => "飛騨支店", 205 => "北陸", 192 => "北陸支店", 78 => "高岡", 233 => '高岡駐在' , 159 => "東濃", 160 => "東濃(営）", 88 => "滋賀", 89 => "滋賀(営）", 56 => "関西統括部　北近畿支店", 53 => "関西CS", 54 => "関西CSG", 189 => "北近畿", 167 => "南近畿", 210 => "南近畿支店", 109 => "神戸", 111 => "神戸（営）", 131 => "大阪", 132 =>"大阪支店", 183 => "福山", 184 => '福山支店', 42 => "岡山", 43 => "岡山支店", 158 => "東広島", 239 => '東広島(営)', 257 => '東広島駐在' , 72 => "広島", 73 => "広島支店", 102 => "松山", 176 => "姫路", 177 => "姫路(営）", 206 => "山口", 76 => "香川", 77 => "香川（営）", 101 => "松江", 229 => '松江(営)' , 153 => "鳥取", 87 => "四国CS", 227 => '中四国' , 231 => '中四国 松山' , 139 => "中四国 松江", 140 => "中四国 福山",
		141 => "中四国CS", 142 => "中四国CSG", 106 => "新居浜", 107 => "新居浜支店", 212 => '西九州' , 119 => "西九州支店", 213 => '西九州支店 長崎駐在' , 190 => "北九州", 191 => "北九州駐在", 66 => "九州CS", 67 => "九州CSG", 69 => "九州統括", 98 => "出水", 99 => "出水駐在", 40 => "宇佐", 180 => "福岡", 224 => '福岡支店' , 182 => "福岡南", 64 => "宮崎", 219 => '宮崎支店' , 79 => "佐賀", 68 => "九州CSG佐賀", 155 => "都城", 70 => "熊本", 71 => "熊本支店", 154 => "天草", 156 => "島原", 157 => "島原駐在", 137 => "大分", 230 => '大分支店' ,149 => "長崎", 150 => "長崎支店", 220 => '長崎駐在' , 91 => "鹿児島", 226 => '鹿児島支店' , 44 => "沖縄" , 246 => '沖縄(九州CS)' , 164 => "道東住重建機㈱", 269 => '中部住重建機㈱名古屋', 235 => '中部住重建機㈱美濃' , 148 => "中部住重建機㈱白鳥営業所", 147 => "中部住重建機㈱岐阜営業所", 134 => "大阪住重建機㈱大阪サービス課",
		135 => "大阪住重建機販売㈱大阪支店", 253 => '大阪住重建機㈱' , 249 => '大阪住重建機㈱京奈' , 133 => "大阪住重建機㈱三田", 265 => '住友建機販売㈱', 96 => "住友建機販売㈱宇都宮営業所", 214 => '住友建機販売㈱長崎営業所' , 38 => "愛和機械" , 47 => "㈱イシショウ" , 243  => 'イワセ重機産業㈱' , 49 => "㈱イシショウ宇部", 50 => "㈱イシショウ小野田", 207 => "㈱イシショウ周南", 208 => "㈱イシショウ山口", 248 => '㈱澄川工作所' , 52 => "㈱中島建機", 51 => "㈱ニットク", 2 => "(鹿児島)ニットク", 170 => "日本海重機サービス", 172 => "飯塚建機サービス", 197 => "由利（営）", 198 => "由利駐在", 195 => "木曽整備", 196 => '木曽整備工場', 36 => 'パークス木曽整備' ,  35 => "パークス甲信越 木曽整備", 34 => "パークス甲信越　大町整備", 33 => "パークス甲信越 松本整備", 108 => "新明和ディーゼル", 238 => 'キナン大垣' , 32 => "キナン津", 27 => "キナン志摩", 254 => 'キナン紀伊長島' , 29 => "キナン上野", 261 => "キナン名張", 263 => 'キナン四日市北', 28 => "キナン松阪", 31 => "キナン滝原", 30 => "キナン新宮　", 256 => '共和建商', 267 => '㈱キングサービス' , 200 => "鈴鹿建機(株)",
        236 => '三河機工' , 84 => '三協建機', 85 => "三協建機(株)米子工場", 259 => '三協建機㈱倉吉工場', 136 => "大住京奈", 138 => "第一自動車工業㈱", 100 => "昭和車輌", 217 => '土木車輌' , 65 => "宮本重機械", 124 => "千代田機電㈱", 228 => '千代田機電㈱七尾営業所', 266 => '千代田機電㈱金沢北営業所', 186 => "北海道　川重建機㈱ " , 247 => '川重　札幌' , 252 => '川重　函館' , 223 => '佐久本工機' , 241 => 'ブルドーザー整備㈱', 268 => '㈲県南重車輌整備工場' , 179 =>"不明" );

		return $item;
	}

}
