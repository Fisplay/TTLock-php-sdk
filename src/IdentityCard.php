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
	public function delete( int $lockId, int $icCardId, ?int $deleteType, int $date ):array
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
		if( $response->getStatusCode() === 200 && (!isset($body['errcode']) || $body['errcode'] === 0)) {
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
	public function add( int $lockId, string $icCard, ?string $icCardName, int $startDate, int $endDate, ?int $addType, int $date ) : array
	{
		return $this->create(
			'/v3/identityCard/add',
			$lockId,
			$icCard,
			$icCardName,
			$startDate,
			$endDate,
			$addType,
			$date
		);
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
	public function addForReversedCardNumber( int $lockId, string $icCard, ?string $icCardName, int $startDate, int $endDate, ?int $addType, int $date ) : array
	{
		return $this->create(
			'/v3/identityCard/addForReversedCardNumber',
			$lockId,
			$icCard,
			$icCardName,
			$startDate,
			$endDate,
			$addType,
			$date
		);
	}

	/**
	 * @param string $endpoint
	 * @param integer $lockId
	 * @param string $icCard
	 * @param string|null $icCardName
	 * @param integer $startDate
	 * @param integer $endDate
	 * @param integer|null $addType
	 * @param integer $date
	 * @return array
	 */
	protected function create(string $endpoint, int $lockId, string $icCard, ?string $icCardName, int $startDate, int $endDate, ?int $addType, int $date): array
	{
		$response = $this->client->request('POST', $endpoint, [
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
		]);

		$body = json_decode( $response->getBody()->getContents(), true );

		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array) $body;
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
	public function updateValidity( int $lockId, int $cardId, int $startDate, int $endDate, ?int $changeType, int $date ) : array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/changePeriod', [
			'form_params' => [
				'clientId'    => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId'      => $lockId,
				'cardId'  	  => $cardId,
				'startDate'   => $startDate,
				'endDate'     => $endDate,
				'changeType'  => $changeType,
				'date'        => $date,
			],
		] );
		$body = json_decode( $response->getBody()->getContents(), true );
		if( $response->getStatusCode() === 200 && (!isset($body['errcode']) || $body['errcode'] === 0)) {
			return (array)$body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}

	/**
	 * @method GET
	 * @param int         $lockId
	 * @param int         $pageNo
	 * @param int         $pageSize
	 * @param int         $orderBy
	 * @param int         $date
	 * @param string|null $searchString
	 * @return array
	 * @throws \GuzzleHttp\Exception\GuzzleException | \Exception
	 */
	public function find(int $lockId, int $pageNo, int $pageSize, int $orderBy = 0, int $date = 0, ?string $searchString = null):array
	{
		$response = $this->client->request( 'POST', '/v3/identityCard/list', [
			'form_params' => [
				'clientId' => $this->clientId,
				'accessToken' => $this->accessToken,
				'lockId' => $lockId,
				'searchStr' => $searchString,
				'pageNo' => $pageNo,
				'pageSize' => $pageSize,
				'orderBy' => $orderBy,
				'date' => $date,
			],
		] );

		$body = json_decode( $response->getBody()->getContents(), true );

		if( $response->getStatusCode() === 200 && !isset( $body['errcode'] ) ){
			return (array) $body;
		} else{
			throw new \Exception( "errcode {$body['errcode']} errmsg {$body['errmsg']} errmsg : {$body['errmsg']}" );
		}
	}
}
