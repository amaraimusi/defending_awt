<?php 
require_once 'BaseX.php';

/**
 * パトロールアクションのモデル
 * @author uehara
 *
 */
class PatrolAction extends BaseX{

	private $dangerData; // 危険データ
	
	
	// 危険データのGetter
	public function getDangerData(){
		if(empty($this->dangerData)){
			$this->dangerData = $this->getDangerDataFromJson();
		}
		return $this->dangerData;
	}

	
	// 正パスマップを作成する
	public function createCorrectMap($correctData){
		
		$map = [];
		foreach($correctData as $ent){
			$path_name = $ent['path_name'];
			$map[$path_name] = $ent;
		}

		return $map;
	}
	
	// 危険削除
	public function deleteDanger($path_name){

		// 危険データにパス名を指定して危険エンティティを取得する
		$dangerEnt = $this->getDangerEntByPathName($path_name);

		try {
			// ★ 危険と思われるパスを削除する
			$this->removePath($path_name);
			
			//$this->delPath($path_name);
			
			$dangerEnt['del_flg'] = 1;
			$dangerEnt['del_dt'] = date('Y-m-d H:i:s');
			$dangerEnt['comment'] = "「{$path_name}」を削除しました。";
		} catch (Exception $e) {
			$dangerEnt['comment'] = "「{$path_name}」の削除に失敗しました。";
			
		}
		
		
		// 危険エンティティを危険データにセットする
		$this->setDangerEnt($path_name, $dangerEnt);
		
		dump($dangerEnt);//■■■□□□■■■□□□)

		return [
				'danger_flg'=>1, // 危険検知フラグ 0:検出なし, 1:危険検出
				
		];
		
	}
	
	// 危険データにパス名を指定して危険エンティティを取得する
	private function getDangerEntByPathName($path_name){
		
		$dangerData = $this->getDangerData();
		foreach($dangerData as $ent){
			if($ent['path_name'] == $path_name) return $ent;
		}
		
		// 続き→デフォルトの取得をここにいれる。
		$ent = $this->getDefaultDangerEnt($path_name);
		$this->dangerData[] = $ent;
		
		return $ent;
	}
	
	//  デフォルト危険エンティティを取得する
	private function getDefaultDangerEnt($path_name){
		return [
				'path_name' => $path_name,
				'del_flg'=> 0,
				'del_dt' => '',
				'warning_flg'=>0,
				'warning_dt'=>0,
				'comment' => '',
		];
	}
	
	// 危険エンティティを危険データにセットする
	public function setDangerEnt($path_name, $p_dangerEnt){
		
		$dangerData = $this->dangerData;
		
		foreach($dangerData as $i =>$dangerEnt){
			if($dangerEnt['path_name'] == $path_name){
				$this->dangerData[$i] = $p_dangerEnt;
			}
		}
		
	}
	
	
	/**
	 * パスを削除します。
	 * @note 
	 * ディレクトリごとファイルを削除できます。
	 * 階層化のファイルまで削除可能。
	 * もちろん通常のファイルも削除可能。
	 * パスの指定先にファイルやディレクトリが無くてもエラーになりません。
	 * 
	 * @param string $path 削除対象ディレクトリ(絶対パスで指定する。セパレータはスラッシュ、バックスラッシュが混在しても良い）
	 * @return [] 削除に失敗したパス名のリスト
	 */
	public function removePath($path){
		$falseData = [];
		$this->removePath0($path, $falseData);
		return $falseData;
	}
	
	/**
	 * パスを削除します。　このメソッドは再帰呼び出し処理がなされています。
	 * @note 
	 * ディレクトリごとファイルを削除できます。
	 * 階層化のファイルまで削除可能。
	 * もちろん通常のファイルも削除可能。
	 * パスの指定先にファイルやディレクトリが無くてもエラーになりません。
	 * 
	 * @param string $path 削除対象ディレクトリ(絶対パスで指定する。セパレータはスラッシュ、バックスラッシュが混在しても良い）
	 * @param [] $falseData 失敗ファイルリスト     削除に失敗したパスの情報
	 * @return [] 削除に失敗したパス名のリスト
	 */
	private function removePath0($path, &$falseData) {
		
		
		// ディレクトリでないなら即削除
		if (!is_dir($path)) {
			
			if(@unlink($path) == false) $falseData[] = $path; // 「@」を付けることにより、ディレクトリやファイルが存在しなくてもWarningがでないようにする。

			return $falseData;
		}
		if ($handle = opendir($path)) {
			while (false !== ($item = readdir($handle))) {
				if ($item != "." && $item != "..") {
					$dp = $path . '/' . $item;
					if (is_dir($dp)) {
						$this->removePath0($dp, $falseData);
					} else {
						if(@unlink($dp) == false) $falseData[] = $path; // ファイルを削除。失敗した場合は失敗リストにパス名を追加する。
					}
				}
			}
			closedir($handle);
			if(rmdir($path) == false) $falseData[] = $path; // ディレクトリを削除。失敗した場合は失敗リストにパス名を追加する。
		}
		
		return $falseData;
	}
	
	
	
	
}