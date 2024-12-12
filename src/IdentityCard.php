<?php

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
	 * @param int $lockId
	 * @param int $icCardId
	 * @param int $deleteType
	 * @param int $date
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function delete( int $lockId, int $icCardId, int $deleteType, int $date ):array
	{
		$response = $this->client->request('POST', '/v3/identityCard/delete', [
			'form_params' => [
				'clientId'      => $this->clientId,
				'accessToken'   => $this->accessToken,
				'lockId'        => $lockId,
				'cardId' 		=> $icCardId,
				'deleteType'    => $deleteType,
				'date'          => $date,
			],
		]);
		$body = json_decode( $response->getBody()->getContents(), true );
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
				'cardNumber'  => $icCard,
				'cardName' 	  => $icCardName,
				'startDate'   => $startDate,
				'endDate'     => $endDate,
				'addType'     => $addType,
				'date'        => $date,
			],
		] );
		$body = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
}
