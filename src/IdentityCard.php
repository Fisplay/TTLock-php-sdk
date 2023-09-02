<?php
/**
 *
 * Copyright  FaShop
 * License    http://www.fashop.cn
 * link       http://www.fashop.cn
 * Created by FaShop.
 * User: hanwenbo
 * Date: 2018/11/20
 * Time: 10:31 AM
 *
 */

namespace ttlock;

class IdentityCard extends TTLockAbstract
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
	 * 文档地址：http://open.ttlock.com.cn/doc/api/v3/identityCard/get
	 * @param int $lockId
	 * @param int $icCardVersion
	 * @param int $icCardType
	 * @param int $startDate
	 * @param int $endDate
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function get( int $lockId, int $icCardVersion, int $icCardType, ?int $startDate, ?int $endDate, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/get', [
			'form_params' => [
				'clientId'           => $this->clientId,
				'accessToken'        => $this->accessToken,
				'lockId'             => $lockId,
				'icCardVersion' => $icCardVersion,
				'icCardType'    => $icCardType,
				'startDate'          => $startDate,
				'endDate'            => $endDate,
				'date'               => $date,
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
	 * @param int $lockId
	 * @param int $icCardId
	 * @param int $deleteType
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function delete( int $lockId, int $icCardId, int $deleteType, int $date ):array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/delete', [
			'form_params' => [
				'clientId'      => $this->clientId,
				'accessToken'   => $this->accessToken,
				'lockId'        => $lockId,
				'icCardId' => $icCardId,
				'deleteType'    => $deleteType,
				'date'          => $date,
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
	 * @param int    $lockId
	 * @param int    $icCardId
	 * @param string $newIcCard
	 * @param int    $startDate
	 * @param int    $endDate
	 * @param int    $changeType
	 * @param int    $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function change( int $lockId, int $icCardId, string $newIcCard, ?int $startDate, ?int $endDate, int $changeType, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/change', [
			'form_params' => [
				'clientId'       => $this->clientId,
				'accessToken'    => $this->accessToken,
				'lockId'         => $lockId,
				'icCardId'  => $icCardId,
				'newIcCard' => $newIcCard,
				'startDate'      => $startDate,
				'endDate'        => $endDate,
				'changeType'     => $changeType,
				'date'           => $date,
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
	 * @method GET
	 * @param int    $lockId
	 * @param string $icCard
	 * @param int    $startDate
	 * @param int    $endDate
	 * @param int    $addType
	 * @param int    $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function add( int $lockId, string $icCard, string $icCardName, int $startDate, ?int $endDate, ?int $addType, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/add', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'icCard' => $icCard,
				'icCardName' => $icCardName,
				'startDate'   => $startDate,
				'endDate'     => $endDate,
				'addType'     => $addType,
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
	 * @param int $lockId
	 * @param int $pageNo
	 * @param int $pageSize
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function list( int $lockId, int $pageNo, int $pageSize, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/list', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
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