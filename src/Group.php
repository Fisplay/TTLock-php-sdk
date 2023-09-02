<?php

namespace ttlock;
class Group extends TTLockAbstract
{

	/**
	 * @var string
	 */
	private $accessToken = '';

	public function setAccessToken( string $accessToken ) : void
	{
		$this->accessToken = $accessToken;
	}

	/**
	 * @method GET
	 * @param strint $name
     * @param int    $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function add(string $name, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/group/add', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'name' => $name,
				'date'        => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

    /**
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function list( int $pageNo, int $pageSize, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/group/list', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'pageNo'      => $pageNo,
				'pageSize'    => $pageSize,
				'date'        => $date,
			],
		] );
		$body     = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
}