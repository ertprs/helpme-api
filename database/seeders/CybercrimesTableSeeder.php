<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CybercrimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $crimes = array([
            "crime" => "Golpe do auxílio emergencial",
            "descricao" => "Como funciona o golpe: Por meio de uma mensagem, o golpista ilude a pessoa afirmando
            que ela se enquadra no perfil para receber ajuda financeira do Governo, no valor que varia entre
            R$600,00 e R$1.200,00. Para ter acesso ao dinheiro, bastaria fazer um cadastro por meio do link
            informado na mensagem. Aí que está a armadilha! Nesse link, a vítima deve informar dados
            pessoais, como CPF, endereço, número da conta bancária e senha. O problema é que, a partir
            dessas informações, o cibercriminoso efetua diversos golpes, como abrir contas em bancos
            virtuais e solicitar cartões de crédito; ou abrir uma empresa fantasma em nome da vítima."
        ], [
            "crime" => "Golpe em sites de compras online",
            "descricao" => "Como funciona o golpe: A vítima faz um anúncio em algum site de compras on-line,
            expondo seu número de telefone para contato. De posse do número de telefone, o golpista, por
            mensagem ou ligação telefônica, engana a vítima dizendo que há a necessidade de atualização da
            conta/cadastro no site ou verificação do anúncio. Para validar a “atualização” ou “confirmação” do
            anúncio, o golpista solicita que a vítima lhe informe os 06 dígitos numéricos que ela receberá via
            SMS em seu celular. Todavia, estes números são, na verdade, o código de validação da conta do
            WhatsApp."
        ], [
            "crime" => "Golpe do falso site de internet",
            "descricao" => "Como funciona o golpe: Bandidos criam sites falsos de venda de mercadoria (eletrônicos,
            eletrodomésticos, etc.). Este golpe costuma ter maior incidência em datas comemorativas e
            promocionais, como por exemplo, a Black Friday. O golpista usa endereços de empresas famosas,
            alterando só o final do endereço eletrônico, bem como usam o layout dos sites conhecidos, tudo
            para ludibriar a vítima, fazendo-a pensar que se trata do site verdadeiro"
        ], [
            "crime" => "Golpe do intermediador de vendas",
            "descricao" => "Como funciona o golpe: O golpista pega o telefone da vítima em sites de compras, e diz que
            tem interesse no objeto anunciado. Com o início da negociação, ele pede para que o anúncio seja
            retirado da plataforma. Com as informações do bem anunciado, o golpista cria um novo anúncio
            com as fotos da vítima, mas com um valor bem abaixo do preço praticado, o que desperta interesse
            de outras vítimas. Com a vítima interessada em vender o bem o golpista diz que comprará e pagará
            uma dívida que possui com algum cliente, sócio, amigo ou irmão, e, portanto pede silêncio no
            momento da apresentar o objeto para a segunda vítima, prometendo algum lucro financeiro nesta
            negociação silenciosa. Já a vítima interessada em comprar, também é orientada a se manter em
            silêncio e por isso ganhará um desconto. Com todo esse enredo, o golpista fornece uma ou
            algumas contas bancárias diversas da conta da vítima que está vendendo o bem, normalmente de
            terceiros “laranjas”. Com a transferência ou até antes dela, as vítimas ainda são orientadas a irem
            até um cartório e preencherem o recibo do veículo (quando a negociação é de carro), tudo para dar
            mais veracidade ao golpe. Quando ambas as vítimas percebem o golpe, o recibo já foi preenchido
            e todo o dinheiro da negociação foi parar na conta de um bandido, que logo em seguida saca todo o
            montante da conta, o que impede a recuperação do dinheiro. "
        ], [
            "crime" => "Golpe do depósito com envelope vazio",
            "descricao" => "Como funciona o golpe: Geralmente a vítima fez algum anúncio para venda de um
            determinado bem/objeto. O anúncio normalmente é feito pela internet em sites de compras ou por
            redes sociais. Após a negociação, o golpista faz o depósito do valor acertado em um caixa
            eletrônico ou lotérica, mas não deposita dentro do envelope o valor do bem/objeto. O golpista
            encaminha foto do comprovante de depósito e a vítima confirma o recebimento em consulta à sua
            conta pelo aplicativo do banco. Como a verificação bancária do depósito demora algumas horas,
            ou às vezes só é realizada no próximo dia útil, o valor fica aparecendo como depositado até que se
            verifique que o depósito não foi satisfeito. Até lá, a vítima já entregou o bem (normalmente o
            golpista manda um motorista por aplicativo buscar no mesmo dia do depósito o objeto)."
        ], [
            "crime" => "Clonagem do whatsapp",
            "descricao" => "Como funciona o golpe: Os golpistas têm diversos meios de conseguir o número da vítima,
            mas o mais usual é que seja retirado de anúncios em plataformas de sites de compras ou anúncios
            públicos (que abrangem não só os contatos da vítima) em redes sociais. As vítimas recebem um
            torpedo de SMS no qual consta um código de 6 dígitos. O golpista se passa por funcionário da
            plataforma de anúncio e solicita este código, alegando que isso é necessário para ativar o anúncio.
            Outras vezes alegam que houve duplicidade de anúncio, com valores diferentes. Para tal,
            solicitam a verificação da vítima com dados pessoais (nome completo, CPF, RG, endereço) e
            finalizando solicitam o código de 6 dígitos. Este código é uma verificação do WhatsApp, ou seja, o
            golpista digitou o número de celular da vítima no celular dele para ativar o WhatsApp. Este código
            de verificação para habilitar o WhatsApp foi enviado para o celular da vítima. É por este motivo que
            o bandido solicita o código, se aproveitando da vítima, de que este seria um passo necessário para
            habilitar o anúncio, induzindo a vítima a fornecê-lo. De posse desse código o golpista desvia o
            WhatsApp da vítima para o aplicativo instalado no celular dele, e a vítima perde o acesso ao
            aplicativo. Com tal feito, ele conversa com os amigos da vítima, se fazendo passar por ela, fala
            que está sem dinheiro, com algum problema na conta ou cartão de crédito bloqueado e solicita
            dinheiro emprestado, se comprometendo a pagar no dia seguinte. Os amigos da vítima,
            acreditando estarem falando com pessoa de sua confiança, acabam transferindo o dinheiro para a
            conta bancária informada, que normalmente é de algum laranja. Assim que a transferência é feita,
            eles também se tornam vítima do golpe."
        ], [
            "crime" => "Golpe do bilhete premiado",
            "descricao" => "Como funciona o golpe:Avítima (muitas vezes idosa) é abordada por uma pessoa humilde,
            que pede algumas informações, dizendo ter um bilhete de loteria premiado. O golpista, suposto
            ganhador da loteria, alega ter medo de ser enganado na hora de resgatar o prêmio ou que não teria
            os documentos necessários para sacar o prêmio, ou ainda que tem ações na justiça que o
            impediriam de receber o prêmio. Há vezes ainda em que o golpista alega motivos religiosos para
            não aceitar a premiação. Em seguida entra em cena o segundo golpista, um sujeito mais bem
            arrumado, que alega ter ouvido toda a conversa. Às vezes o primeiro golpista também aborda o
            seu comparsa, como se quisesse tirar alguma dúvida. Este segundo sujeito simula falar com
            alguém da Caixa Econômica Federal para confirmar a veracidade do prêmio. Nesse ponto, o
            golpista bem vestido propõe que a vítima fique com o bilhete e em contrapartida, repasse algum
            valor para o suposto ganhador do prêmio. Geralmente eles acompanham a vítima até uma agência
            bancária para fazer o saque do dinheiro, ou transferência “como garantia de que o humilde suposto
            ganhador não seja enganado”, e então entregam o bilhete premido."
        ], [
            "crime" => "Golpe do falso sequestro",
            "descricao" => "Como funciona o golpe: O golpista liga de maneira aleatória para diversos números.
            Geralmente ele está preso e possui tempo de sobra para efetuar ligações. A vítima atende e o
            bandido grita no fundo, como se fosse uma pessoa “sequestrada”. A vítima desesperada fala o
            nome de um filho, sobrinho, alguém próximo. Com isso, o bandido consegue a informação que ele
            queria para fazer a vítima acreditar que se trata de um sequestro de verdade. No desespero, a
            vítima não percebe que foi ela mesma quem forneceu o nome do sequestrado, e às vezes, com o
            nervosismo, não percebe a diferença na voz. Neste momento o golpista pede que a vítima não
            desligue, que ela fique na linha até que alguém faça a transferência de um determinado valor para
            a conta de algum 'laranja'."
        ], [
            "crime" => "Golpe do cartão de crédito clonado",
            "descricao" => "Como funciona o golpe: O golpista faz contato com a vítima se apresentando como alguém
            do cartão de crédito alegando que houve uma compra duvidosa no cartão da vítima e solicita que
            esta confirme ou não a compra. Como a vítima não reconhece esta compra, o golpista solicita que
            a vítima ligue para o 0800 que consta no verso do cartão para solicitar o cancelamento da compra e
            bloqueio do cartão. Neste momento, a vítima não percebe que o golpista continuou na ligação.
            Após “discar” para o 0800, o golpista coloca uma gravação como se fosse do banco. Acreditando
            que está falando com uma pessoa da operadora do cartão, acaba fornecendo seus dados
            pessoais (nome completo, RG, CPF, data de nascimento e endereço para onde é encaminhada a
            fatura) e do cartão de crédito (número do cartão, nome como consta no cartão, data de vencimento
            da fatura, data de validade do cartão e código verificador – aquele de 3 dígitos no verso do cartão e
            senha). Depois de obter estas informações, o suposto atendente do cartão informa que enviará
            uma pessoa (funcionário do banco ou motoboy que trabalhe para o banco) para recolher o cartão
            clonado. Com o cartão em mãos e todos os dados pessoais da vítima, os golpistas fazem compras
            em diversas lojas físicas ou sites."
        ], [
            "crime" => "Golpe da troca de cartão",
            "descricao" => "Como funciona o golpe:Avítima, após ser observada inserindo os dados do cartão no caixa
            eletrônico por um dos golpistas, é abordada ao sair da agência bancária por pessoa que se
            apresenta como funcionário do banco. O golpista normalmente está bem vestido e apresenta um
            “crachá” do banco. Esta pessoa alega que houve algum problema na transação efetuada ou na
            máquina e solicita que a vítima retorne ao caixa eletrônico para verificarem a transação. Neste
            momento ele “auxilia” a vítima e rapidamente efetua a troca do cartão. Às vezes o golpista solicita
            apenas para verificar o cartão e neste momento efetua a troca."
        ], [
            "crime" => "Golpe do boleto falso",
            "descricao" => "Como funciona o golpe: Em tempos de pandemia, em razão do isolamento, muitas pessoas
            estão fazendo compras pela internet, redes sociais e até mesmo WhatsApp. Muitas vezes a vítima
            não está com acesso seguro aos sites visitados, seja pelo computador, seja pelo celular. Diversas
            são as formas de manipular a vítima neste momento. Pode ser por uma falsa página de alguma loja
            ou falso contato pelo WhatsApp para venda direta. Neste momento é emitido o boleto bancário
            para pagamento da compra efetuada. Este boleto possui cabeçalho e imagens aparentemente da
            loja/empresa em que a vítima estava negociando. O golpe pode ser realizado tanto com a
            manipulação do código de barras do documento ou com a criação de páginas falsas que oferecem
            o download da 'fatura'. Neste momento o valor transferido/pago vai para a conta bancária do
            golpista ou de um 'laranja'."
        ], [
            "crime" => "Golpe do falso empréstimo",
            "descricao" => "Como funciona o golpe: Os golpistas fazem anúncios em sites, redes sociais ou até mesmo
            ofertas pelo WhatsApp. A oferta é bem tentadora: crédito fácil e rápido, juros mais baixos do que
            aqueles operados por Instituições Financeiras, possibilidade de pagar em diversas parcelas, sem
            consulta ao SPC/Serasa, e, caso a vítima esteja negativada, não impediria a concessão do crédito.
            Onde entra o golpe? Eles alegam que para que o crédito seja liberado para a vítima, é necessário
            que ela pague uma taxa! Os golpistas usam diversas alegações, seja taxa de abertura de crédito,
            taxa exigida pelo Banco Central, seguro de crédito, e por aí vai."
        ], [
            "crime" => "Golpe da troca de fotos íntimas",
            "descricao" => "Como funciona o golpe: Os golpistas utilizam as redes sociais para enganar suas vítimas.
            As vítimas podem ser homens ou mulheres, mas mais usualmente são homens, maiores de idade,
            e muitas vezes casados. O golpista utiliza um perfil falso, muitas vezes com a foto de uma jovem
            bonita e atraente. Eles começam uma amizade e logo o golpista, seja uma 'jovem moça' ou um
            “rapaz atraente”, envia fotos íntimas suas e pede para que a vítima faça o mesmo. De posse
            dessas fotos íntimas da vítima, outro golpista entra em cena: o suposto pai ou padrasto da(o)
            jovem, alegando que este último é menor de idade e que a vítima estaria praticando o crime de
            pedofilia pela internet. Para que o pai/padrasto não leve o caso para a Polícia, ou não conte tudo
            para a esposa/marido da vítima, exige que seja paga uma quantia em dinheiro. Algumas vezes, os
            golpistas se fazem passar por policiais civis, alegando que as fotos já fazem parte de um Inquérito
            Policial e solicitam o depósito para que 'a investigação seja arquivada'."
        ], [
            "crime" => "Golpe do parente que quebrou o carro",
            "descricao" => "Como funciona o golpe: O golpista liga aleatoriamente para as vítimas. Dependendo se
            quem atende for homem ou mulher, ele logo fala: 'oi tio/tia, sabe quem está falando?' Caso a
            vítima diga um nome, achando ser algum sobrinho ou parente distante, já deu para o golpista o
            que ele queria. Algumas vezes a vítima fala que não se recorda e o golpista usa do artifício
            'nossa, não lembra mais de mim'. A vítima, constrangida, acaba continuando o diálogo e se
            sujeitando ao que o golpista fala. Com isso, ele conta uma história que seu carro quebrou e
            que precisa de ajuda, solicitando que a vítima faça uma transferência para determinada conta
            (seja do mecânico, da ferragem, ou da borracharia para pagar o conserto do carro)."
        ], [
            "crime" => "Golpe do book foto gráfico",
            "descricao" => "Como funciona o golpe: Geralmente as vítimas aqui abordadas são idosas. Os golpistas
            abordam os mais idosos com a promessa de brindes, maquiagens e fotos gratuitas. Assim,
            após serem persuadidas, as vítimas aceitam fazer as fotos nos pequenos estúdios. Depois de
            uma produção de maquiagem, trocas de roupas e diversas fotos vem a surpresa: na saída as
            vítimas são constrangidas a pagar pelas fotos com valores bem altos."
        ]);

        for ($i = 0; $i < sizeOf($crimes); $i++) {
            DB::table('cybercrimes')->insert($crimes[$i]);
        }
    }
}
